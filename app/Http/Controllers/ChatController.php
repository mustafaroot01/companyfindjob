<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Handle the incoming chat message.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
        ]);

        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['error' => 'API Key is missing in configuration'], 500);
        }

        $message = $request->input('message');
        $context = $request->input('context'); // Extracted text from files
        $mode = $request->input('mode', 'chat'); // 'chat' or 'interview'

        $systemPrompt = "";

        if ($mode === 'interview') {
            $systemPrompt = "أنت مدير توظيف صارم ولكنه عادل (Hiring Manager). مهمتك هي إجراء مقابلة عمل مع المستخدم.\n" .
            "1. اطرح سؤالاً واحداً فقط في كل مرة.\n" .
            "2. بعد أن يجيب المستخدم، قم بتقييم إجابته باقتضاب (ممتازة، جيدة، تحتاج تحسين) ثم اطرح السؤال التالي فوراً.\n" .
            "3. لا تخرج عن الشخصية أبداً. تعامل بمهنية ورسمية.\n" .
            "4. ركز أسئلتك على خبرات المستخدم المذكورة في سيرته الذاتية (إذا وجدت).\n";
            
            if ($context) {
                $systemPrompt .= "\n[سيرة المرشح الذاتية]:\n" . $context . "\n\nاستند في أسئلتك على هذه السيرة.";
            }

        } else {
            // Default Chat Mode
            $systemPrompt = "أنت المساعد الذكي لمنصة 'وظيفتي' (Wazifaty). وظيفتك هي مساعدة الباحثين عن عمل وأصحاب العمل في العراق.\n" .
            "يجب أن تكون إجاباتك مهنية، مشجعة، وباللغة العربية الفصحى أو اللهجة العراقية البيضاء المفهومة.\n";

            if ($context) {
                $systemPrompt .= "\n\n[الملف المرفق (سيرة ذاتية / وصف وظيفي)]:\n" . $context . "\n\n" . 
                "⚠️ تعليمات خاصة لتحليل الملف المرفق:\n" .
                "1. **تحليل المسار المهني:** بناءً على الخبرات المذكورة، اقترح المسمى الوظيفي الأنسب والخطوة التالية المنطقية للباحث.\n" .
                "2. **تحسين السيرة الذاتية:** حدد نقاط الضعف في النص (مثل نقص الأرقام، الإنجازات، أو الكلمات المفتاحية) واقترح تعديلات ملموسة.\n" .
                "3. **تنمية المهارات:** اقترح 3-5 مهارات تقنية أو ناعمة يجب على الباحث تعلمها لزيادة راتبه أو فرص توظيفه.\n" .
                "4. **نصائح المقابلة:** استخرج سؤالين محتملين قد يسألهما صاحب العمل بناءً على خبرة هذا الشخص بالتحديد.\n\n" .
                "تحدث مع المستخدم بأسلوب المستشار المحترف، واستخدم المعلومات من الملف للإجابة.";
            } else {
                $systemPrompt .= "يمكنك تقديم نصائح حول: 
                1. كتابة السيرة الذاتية (CV).
                2. قراءة وتحليل الوظائف.
                3. التحضير للمقابلات.
                4. مهارات التواصل المهني.";
            }

            $systemPrompt .= "\n\nلا تجب على أسئلة خارج نطاق المهن والتوظيف. إذا سُئلت عن شيء آخر، اعتذر بلطف وأعد توجيه المستخدم لخدمات المنصة.";
        }

        // Build System Instruction
        $systemInstructionParsed = [
            'parts' => [['text' => $systemPrompt]]
        ];

        // Process History
        $contents = [];
        $history = $request->input('history', []);

        foreach ($history as $turn) {
            $role = ($turn['role'] === 'user') ? 'user' : 'model';
            $text = $turn['content'];
            
            // Skip empty messages or system messages if they somehow got in
            if (empty($text)) continue;

            $contents[] = [
                'role' => $role,
                'parts' => [['text' => $text]]
            ];
        }

        // Add Current User Message
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $message]]
        ];

        // List of models and endpoints to try in order
        // Based on available models: gemini-2.5-flash, gemini-flash-latest, gemini-2.0-flash-lite-001
        $candidates = [
            // Priority 1: Newest Stable Flash (Best performance/quota balance)
            ['url' => "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent", 'model' => 'gemini-2.5-flash'],
            
            // Priority 2: Latest Flash Alias (Usually maps to the current best Flash model)
            ['url' => "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent", 'model' => 'gemini-flash-latest'],
            
            // Priority 3: Flash Lite (High efficiency, good backup)
            ['url' => "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-lite-001:generateContent", 'model' => 'gemini-2.0-flash-lite-001'],
        ];

        $errors = [];

        foreach ($candidates as $candidate) {
            try {
                // SSL verification disabled to prevent local environment issues
                $response = Http::withOptions(['verify' => false])->withHeaders([
                    'Content-Type' => 'application/json',
                    'X-goog-api-key' => $apiKey,
                ])->post($candidate['url'], [
                    'system_instruction' => $systemInstructionParsed,
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 2048, // Increased for detailed analysis
                    ],
                ]);

                if ($response->successful()) {
                    $result = $response->json();
                    $reply = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    
                    if ($reply) {
                        return response()->json(['reply' => $reply]);
                    }
                } else {
                    // Capture error but continue to next candidate
                    $errors[] = "Model {$candidate['model']}: " . $response->body();
                    Log::warning("Gemini Model Strategy Failed: {$candidate['model']}", ['error' => $response->body()]);
                }
            } catch (\Exception $e) {
                $errors[] = "Model {$candidate['model']} Exception: " . $e->getMessage();
                Log::error("Gemini Connection Error: {$candidate['model']}", ['message' => $e->getMessage()]);
            }
        }

        // If we reach here, all candidates failed
        Log::error('All Gemini Models Failed', ['errors' => $errors]);
        
        // Return a generic user-friendly error, logging the details
    }
}

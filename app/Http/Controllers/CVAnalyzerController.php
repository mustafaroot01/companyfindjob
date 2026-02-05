<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CVAnalyzerController extends Controller
{
    public function index()
    {
        return view('cv-analyzer.index');
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'category' => 'required|string',
        ]);

        $text = $request->input('text');
        $category = $request->input('category');
        
        // Define skill sets and impact verbs
        $dictionary = [
            'برمجة' => ['PHP', 'Laravel', 'JavaScript', 'SQL', 'GitHub', 'API', 'Docker', 'React', 'Vue', 'Node', 'Python', 'Java', 'HTML', 'CSS', 'Testing'],
            'تصميم' => ['Figma', 'Photoshop', 'UI/UX', 'Adobe XD', 'Branding', 'Typography', 'Illustrator', 'InDesign', 'Sketch', 'Canva'],
            'محاسبة' => ['Excel', 'IFRS', 'Auditing', 'Taxation', 'ERP', 'Financial Reporting', 'QuickBooks', 'Accounting', 'VAT', 'Budgeting'],
            'تسويق' => ['SEO', 'Content Strategy', 'Social Media', 'Google Analytics', 'Copywriting', 'CRM', 'Email Marketing', 'Ads', 'Marketing'],
            'إدارة' => ['Leadership', 'Project Management', 'Planning', 'Team Building', 'Budgeting', 'Operations', 'Strategy', 'Communication'],
        ];

        $impactVerbs = [
            'طورت', 'أدرت', 'حققت', 'حسنت', 'خططت', 'قُدت', 'أنشأت', 'صممت', 'نفذت', 'حللت', 'نظمت', 'فزت', 'زدت', 'قللت'
        ];

        // 1. Detect Skills
        $targetSkills = $dictionary[$category] ?? [];
        $foundSkills = [];
        foreach ($targetSkills as $skill) {
            if (Str::contains(Str::lower($text), Str::lower($skill))) {
                $foundSkills[] = $skill;
            }
        }

        // 2. Detect Impact Verbs
        $foundImpactVerbs = [];
        foreach ($impactVerbs as $verb) {
            if (Str::contains($text, $verb)) {
                $foundImpactVerbs[] = $verb;
            }
        }

        // 3. Calculate Score
        $skillMatchRatio = count($targetSkills) > 0 ? (count($foundSkills) / count($targetSkills)) : 0.5;
        $verbScore = count($foundImpactVerbs) / 5; // Aim for at least 5 verbs
        $lengthScore = strlen($text) > 500 ? 1 : (strlen($text) / 500);
        
        $rawScore = ($skillMatchRatio * 50) + ($verbScore * 30) + ($lengthScore * 20);
        $score = min(max(round($rawScore), 40), 98); // Keep between 40 and 98

        // 4. Generate Feedback
        $missingSkills = array_diff($targetSkills, $foundSkills);
        $missingSkills = array_slice($missingSkills, 0, 3);
        
        $missingVerbs = array_diff($impactVerbs, $foundImpactVerbs);
        $suggestedVerbs = array_slice($missingVerbs, 0, 3);

        // Category specific data
        $categoryData = [
            'برمجة' => [
                'roadmap' => ['إتقان العمليات السحابية (Cloud computing).', 'المساهمة في مشاريع 오픈 سورس (Open Source).', 'تعلم تقنيات الذكاء الاصطناعي التوليدي.'],
                'skill_dev' => ['التعمق في تقنيات Microservices.', 'تعلم اختبارات الوحدة (Unit Testing) بشكل احترافي.']
            ],
            'تصميم' => [
                'roadmap' => ['دراسة هندسة المعلومات (Information Architecture).', 'إتقان أدوات الموشن جرافيك.', 'تطوير مهارات التقديم للدفاع عن الخيارات التصميمية.'],
                'skill_dev' => ['تعلم تصميم الأنظمة (Design Systems).', 'إتقان أدوات الذكاء الاصطناعي في التصميم.']
            ],
            // ... (other categories can be added here)
        ];

        $extraData = $categoryData[$category] ?? [
            'roadmap' => ['توسيع شبكتك المهنية في مجالك.', 'الحصول على شهادة تخصصية معتمدة.', 'تطوير مهارات القيادة التشاركية.'],
            'skill_dev' => ['تطوير مهارات اللغة الإنجليزية التقنية.', 'إتقان أدوات الذكاء الاصطناعي في الإنتاجية.']
        ];

        return response()->json([
            'score' => $score,
            'target_category' => $category,
            'keywords' => array_map(function($skill) use ($foundSkills) {
                return ['text' => $skill, 'weight' => in_array($skill, $foundSkills) ? 15 : 8];
            }, array_slice($targetSkills, 0, 10)),
            'impact_analysis' => [
                'score' => min(round(count($foundImpactVerbs) * 20), 100),
                'found' => array_slice($foundImpactVerbs, 0, 5),
                'missing' => $suggestedVerbs,
                'feedback' => count($foundImpactVerbs) > 3 
                    ? 'ممتاز! لقد استخدمت لغة قوية تعكس إنجازاتك.' 
                    : 'سيرتك الذاتية تميل للوصف الوظيفي أكثر من الإنجازات، حاول إضافة أفعال قوة مثل ' . implode('، ', $suggestedVerbs) . '.',
            ],
            'career_roadmap' => $extraData['roadmap'],
            'skill_development' => $extraData['skill_dev'],
            'strengths' => [
                count($foundSkills) > 3 ? 'رصدنا مجموعة جيدة من المهارات التقنية المطلوبة' : 'وضوح في سرد الخبرات العملية',
                count($foundImpactVerbs) > 2 ? 'تنسيق لغوي يبرز روح المبادرة' : 'استخدام مصطلحات مهنية واضحة',
                'هيكلية الملف متوافقة مع القارئ الآلي'
            ],
            'improvements' => [
                count($missingSkills) > 0 ? 'نوصي بإضافة مهارات مثل ' . implode(', ', $missingSkills) : 'حاول تحديث مهاراتك التقنية دورياً',
                'يفضل ربط الإنجازات بنتائج رقمية (مثل: حققت نمو بنسبة X)',
                'تأكد من وجود روابط مفعلة لأعمالك أو LinkedIn'
            ],
        ]);
    }
}

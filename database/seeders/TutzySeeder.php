<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Tutor;

class TutzySeeder extends Seeder
{
    public function run(): void
    {
        // ── Subjects ────────────────────────────────────────────
        $subjects = [
            [
                'slug'             => 'english',
                'name'             => 'English',
                'hero_title'       => 'English tutors that help you develop professionally',
                'hero_highlight'   => 'English',
                'hero_description' => 'Connect with expert English tutors for business writing, IELTS prep, conversational fluency, and more.',
                'hero_icon'        => 'language',
            ],
            [
                'slug'             => 'spanish',
                'name'             => 'Spanish',
                'hero_title'       => 'Spanish tutors that help you speak confidently',
                'hero_highlight'   => 'Spanish',
                'hero_description' => 'Learn Spanish with native and certified tutors — from beginner basics to advanced fluency.',
                'hero_icon'        => 'globe',
            ],
            [
                'slug'             => 'math',
                'name'             => 'Mathematics',
                'hero_title'       => 'Math tutors that help you solve with confidence',
                'hero_highlight'   => 'Math',
                'hero_description' => 'From algebra to calculus, find expert math tutors that break down complex concepts clearly.',
                'hero_icon'        => 'calculator',
            ],
            [
                'slug'             => 'coding',
                'name'             => 'Coding',
                'hero_title'       => 'Coding tutors that help you build real projects',
                'hero_highlight'   => 'Coding',
                'hero_description' => 'Learn to code with experienced developers. Build portfolios, ace interviews, ship real software.',
                'hero_icon'        => 'code',
            ],
            [
                'slug'             => 'ai',
                'name'             => 'AI & Machine Learning',
                'hero_title'       => 'AI tutors that help you build real-world skills',
                'hero_highlight'   => 'AI',
                'hero_description' => 'Master machine learning, deep learning, and AI tools with industry practitioners as your guide.',
                'hero_icon'        => 'sparkles',
            ],
            [
                'slug'             => 'science',
                'name'             => 'Science',
                'hero_title'       => 'Science tutors that help you understand the world',
                'hero_highlight'   => 'Science',
                'hero_description' => 'From physics to chemistry and biology — get personalised science tutoring that actually works.',
                'hero_icon'        => 'beaker',
            ],
            [
                'slug'             => 'languages',
                'name'             => 'Languages',
                'hero_title'       => 'Language tutors that help you speak like a native',
                'hero_highlight'   => 'Language',
                'hero_description' => 'Learn any language with verified native speakers and certified language professionals.',
                'hero_icon'        => 'chat',
            ],
        ];

        foreach ($subjects as $data) {
            Subject::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // ── Tutor seed data per subject ─────────────────────────
        $tutorPool = [
            'english' => [
                ['name'=>'Sarah Mitchell','country'=>'United Kingdom','flag'=>'🇬🇧','rate'=>28,'rating'=>4.9,'reviews'=>312,'students'=>189,'lessons'=>1420,'languages'=>'English, French','badge'=>'top_rated','bio'=>'CELTA-certified English teacher with 8+ years helping professionals and students achieve fluency, ace IELTS, and write clearly.','speciality'=>'Business English, IELTS Prep','availability'=>'flexible','type'=>'professional'],
                ['name'=>'James O. Adeyemi','country'=>'Canada','flag'=>'🇨🇦','rate'=>22,'rating'=>4.8,'reviews'=>204,'students'=>130,'lessons'=>980,'languages'=>'English','badge'=>'super_tutor','bio'=>'Native English speaker. I make grammar fun and conversational English easy for all levels.','speciality'=>'Conversational English','availability'=>'weekdays','type'=>'native'],
                ['name'=>'Lena Hoffmann','country'=>'Germany','flag'=>'🇩🇪','rate'=>18,'rating'=>4.7,'reviews'=>156,'students'=>94,'lessons'=>640,'languages'=>'English, German','badge'=>'rising','bio'=>'I understand language learner struggles because I was one. Now I help others reach B2 and C1 levels fast.','speciality'=>'Grammar, Exam Prep','availability'=>'weekends','type'=>'student'],
                ['name'=>'Maria Santos','country'=>'Philippines','flag'=>'🇵🇭','rate'=>15,'rating'=>4.8,'reviews'=>280,'students'=>170,'lessons'=>1100,'languages'=>'English, Filipino','badge'=>'top_rated','bio'=>'Patient and structured English tutor. Specialise in pronunciation correction and accent reduction.','speciality'=>'Pronunciation, Speaking','availability'=>'flexible','type'=>'professional'],
                ['name'=>'David Okonkwo','country'=>'Nigeria','flag'=>'🇳🇬','rate'=>12,'rating'=>4.6,'reviews'=>98,'students'=>60,'lessons'=>410,'languages'=>'English, Igbo','badge'=>null,'bio'=>'Dedicated English tutor helping students pass IELTS and TOEFL with proven strategies.','speciality'=>'IELTS, TOEFL','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Priya Nair','country'=>'India','flag'=>'🇮🇳','rate'=>10,'rating'=>4.7,'reviews'=>142,'students'=>88,'lessons'=>550,'languages'=>'English, Hindi','badge'=>'rising','bio'=>'I specialise in Business English for IT professionals looking to communicate confidently in global teams.','speciality'=>'Business English','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Aiko Tanaka','country'=>'Japan','flag'=>'🇯🇵','rate'=>20,'rating'=>4.5,'reviews'=>72,'students'=>45,'lessons'=>290,'languages'=>'English, Japanese','badge'=>null,'bio'=>'English teacher based in Tokyo helping Japanese speakers overcome the English communication barrier.','speciality'=>'Conversational, Pronunciation','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Carlos Rivera','country'=>'Mexico','flag'=>'🇲🇽','rate'=>14,'rating'=>4.9,'reviews'=>190,'students'=>115,'lessons'=>760,'languages'=>'English, Spanish','badge'=>'super_tutor','bio'=>'Bilingual English tutor. I draw on my Spanish background to explain English grammar in a way that clicks.','speciality'=>'Grammar, Writing','availability'=>'flexible','type'=>'professional'],
            ],
            'spanish' => [
                ['name'=>'Isabella García','country'=>'Spain','flag'=>'🇪🇸','rate'=>24,'rating'=>4.9,'reviews'=>285,'students'=>168,'lessons'=>1200,'languages'=>'Spanish, English','badge'=>'super_tutor','bio'=>'Native Spaniard teaching Castilian Spanish. From beginner to advanced — I make every lesson engaging.','speciality'=>'Conversational Spanish','availability'=>'flexible','type'=>'native'],
                ['name'=>'Lucas Fernández','country'=>'Argentina','flag'=>'🇦🇷','rate'=>18,'rating'=>4.8,'reviews'=>196,'students'=>120,'lessons'=>890,'languages'=>'Spanish, English','badge'=>'top_rated','bio'=>'Rioplatense Spanish expert. Perfect for learners targeting Latin American Spanish and DELE exam prep.','speciality'=>'DELE Exam, Latin Spanish','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Sofia Moreno','country'=>'Colombia','flag'=>'🇨🇴','rate'=>14,'rating'=>4.7,'reviews'=>134,'students'=>82,'lessons'=>520,'languages'=>'Spanish, Portuguese','badge'=>'rising','bio'=>'Friendly and patient Spanish tutor. Focused on making real conversation happen from lesson 1.','speciality'=>'Beginner Spanish','availability'=>'weekends','type'=>'native'],
                ['name'=>'Alejandro Ruiz','country'=>'Mexico','flag'=>'🇲🇽','rate'=>16,'rating'=>4.8,'reviews'=>172,'students'=>104,'lessons'=>710,'languages'=>'Spanish, English','badge'=>null,'bio'=>'Mexican Spanish specialist. Business Spanish and travel Spanish made simple.','speciality'=>'Business Spanish','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Carmen López','country'=>'Spain','flag'=>'🇪🇸','rate'=>22,'rating'=>4.9,'reviews'=>241,'students'=>148,'lessons'=>980,'languages'=>'Spanish, French, English','badge'=>'top_rated','bio'=>'Certified language teacher. I use the communicative approach to get you speaking fast.','speciality'=>'All levels','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Miguel Torres','country'=>'Chile','flag'=>'🇨🇱','rate'=>12,'rating'=>4.6,'reviews'=>88,'students'=>55,'lessons'=>320,'languages'=>'Spanish, English','badge'=>null,'bio'=>'Patient tutor for complete beginners. I build your foundation strong from the start.','speciality'=>'Beginner, A1–B1','availability'=>'weekdays','type'=>'student'],
                ['name'=>'Valentina Cruz','country'=>'Peru','flag'=>'🇵🇪','rate'=>15,'rating'=>4.7,'reviews'=>110,'students'=>68,'lessons'=>430,'languages'=>'Spanish, Quechua, English','badge'=>'rising','bio'=>'Peruvian Spanish teacher specialising in clear neutral accent and grammar for international learners.','speciality'=>'Grammar, Speaking','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Andrés Vega','country'=>'Venezuela','flag'=>'🇻🇪','rate'=>11,'rating'=>4.5,'reviews'=>64,'students'=>40,'lessons'=>255,'languages'=>'Spanish, English','badge'=>null,'bio'=>'Casual and engaging Spanish lessons for adults who want to communicate, not just memorise.','speciality'=>'Conversational','availability'=>'weekends','type'=>'native'],
            ],
            'math' => [
                ['name'=>'Dr. Aisha Patel','country'=>'India','flag'=>'🇮🇳','rate'=>35,'rating'=>4.9,'reviews'=>298,'students'=>180,'lessons'=>1380,'languages'=>'English, Hindi','badge'=>'super_tutor','bio'=>'PhD in Applied Mathematics. I break down calculus, linear algebra and statistics into clear, digestible steps.','speciality'=>'Calculus, Statistics','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Mark Thompson','country'=>'United States','flag'=>'🇺🇸','rate'=>30,'rating'=>4.8,'reviews'=>214,'students'=>132,'lessons'=>940,'languages'=>'English','badge'=>'top_rated','bio'=>'Former engineer turned math tutor. Real-world problem solving is my specialty.','speciality'=>'Algebra, Calculus','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Yuki Watanabe','country'=>'Japan','flag'=>'🇯🇵','rate'=>25,'rating'=>4.7,'reviews'=>162,'students'=>98,'lessons'=>620,'languages'=>'English, Japanese','badge'=>'rising','bio'=>'Structured and methodical approach to mathematics. SAT/GRE math specialist.','speciality'=>'SAT, GRE Prep','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Ahmed Hassan','country'=>'Egypt','flag'=>'🇪🇬','rate'=>15,'rating'=>4.8,'reviews'=>188,'students'=>115,'lessons'=>790,'languages'=>'English, Arabic','badge'=>'top_rated','bio'=>'Patient math tutor for school and university students. I explain the why behind every formula.','speciality'=>'Algebra, Geometry','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Emma Larsson','country'=>'Sweden','flag'=>'🇸🇪','rate'=>28,'rating'=>4.9,'reviews'=>226,'students'=>138,'lessons'=>1020,'languages'=>'English, Swedish','badge'=>'super_tutor','bio'=>'University math lecturer offering private tutoring. Specialise in proof writing and discrete maths.','speciality'=>'Discrete Math, Proofs','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Rahul Sharma','country'=>'India','flag'=>'🇮🇳','rate'=>12,'rating'=>4.6,'reviews'=>94,'students'=>58,'lessons'=>380,'languages'=>'English, Hindi','badge'=>null,'bio'=>'IIT graduate helping school students ace competitive exams with structured practice.','speciality'=>'JEE, Olympiad','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Sophie Dubois','country'=>'France','flag'=>'🇫🇷','rate'=>22,'rating'=>4.7,'reviews'=>128,'students'=>78,'lessons'=>510,'languages'=>'English, French','badge'=>'rising','bio'=>'Friendly tutor specialising in making algebra intuitive through visual methods.','speciality'=>'Algebra, Trigonometry','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Daniel Kim','country'=>'South Korea','flag'=>'🇰🇷','rate'=>18,'rating'=>4.8,'reviews'=>174,'students'=>106,'lessons'=>720,'languages'=>'English, Korean','badge'=>'top_rated','bio'=>'SAT Math expert. I have helped 200+ students score 780+ on SAT Math.','speciality'=>'SAT, ACT Math','availability'=>'flexible','type'=>'professional'],
            ],
            'coding' => [
                ['name'=>'Alex Chen','country'=>'United States','flag'=>'🇺🇸','rate'=>45,'rating'=>4.9,'reviews'=>318,'students'=>192,'lessons'=>1480,'languages'=>'English','badge'=>'super_tutor','bio'=>'Senior software engineer at FAANG. I teach Python, JavaScript, and system design for interviews and real projects.','speciality'=>'Python, JavaScript, System Design','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Ravi Menon','country'=>'India','flag'=>'🇮🇳','rate'=>28,'rating'=>4.8,'reviews'=>234,'students'=>142,'lessons'=>1040,'languages'=>'English, Hindi','badge'=>'top_rated','bio'=>'Full-stack developer. I teach React, Node.js, and SQL to beginners and intermediates.','speciality'=>'React, Node.js, SQL','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Nina Kovač','country'=>'Serbia','flag'=>'🇷🇸','rate'=>22,'rating'=>4.7,'reviews'=>148,'students'=>90,'lessons'=>580,'languages'=>'English, Serbian','badge'=>'rising','bio'=>'Backend engineer and competitive programmer. I help with algorithms, data structures, and CS fundamentals.','speciality'=>'Algorithms, Data Structures','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Tom Williams','country'=>'Australia','flag'=>'🇦🇺','rate'=>38,'rating'=>4.9,'reviews'=>272,'students'=>164,'lessons'=>1200,'languages'=>'English','badge'=>'top_rated','bio'=>'10 years in tech. I teach coding bootcamp prep, portfolio building, and interview skills.','speciality'=>'Bootcamp Prep, Interviews','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Yuna Park','country'=>'South Korea','flag'=>'🇰🇷','rate'=>30,'rating'=>4.8,'reviews'=>196,'students'=>118,'lessons'=>860,'languages'=>'English, Korean','badge'=>'super_tutor','bio'=>'Mobile app developer. Teach iOS (Swift) and Android (Kotlin) from zero to app store.','speciality'=>'iOS, Android','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Marco Bianchi','country'=>'Italy','flag'=>'🇮🇹','rate'=>20,'rating'=>4.6,'reviews'=>102,'students'=>62,'lessons'=>420,'languages'=>'English, Italian','badge'=>null,'bio'=>'Web developer teaching HTML, CSS, and vanilla JavaScript to absolute beginners.','speciality'=>'HTML, CSS, JavaScript','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Arjun Kapoor','country'=>'India','flag'=>'🇮🇳','rate'=>18,'rating'=>4.7,'reviews'=>136,'students'=>84,'lessons'=>560,'languages'=>'English, Hindi','badge'=>'rising','bio'=>'Python specialist focused on data science projects, automation, and machine learning basics.','speciality'=>'Python, Data Science','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Lisa Müller','country'=>'Germany','flag'=>'🇩🇪','rate'=>32,'rating'=>4.8,'reviews'=>182,'students'=>110,'lessons'=>780,'languages'=>'English, German','badge'=>'top_rated','bio'=>'DevOps and cloud engineer. Teaching AWS, Docker, Kubernetes, and CI/CD to developers.','speciality'=>'DevOps, Cloud, AWS','availability'=>'weekdays','type'=>'professional'],
            ],
            'ai' => [
                ['name'=>'Dr. Kevin Zhang','country'=>'United States','flag'=>'🇺🇸','rate'=>60,'rating'=>4.9,'reviews'=>284,'students'=>172,'lessons'=>1260,'languages'=>'English, Mandarin','badge'=>'super_tutor','bio'=>'AI researcher at a top university. I teach machine learning, deep learning, and NLP from scratch to advanced.','speciality'=>'Machine Learning, NLP','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Anjali Singh','country'=>'India','flag'=>'🇮🇳','rate'=>35,'rating'=>4.8,'reviews'=>216,'students'=>132,'lessons'=>960,'languages'=>'English, Hindi','badge'=>'top_rated','bio'=>'Data scientist at a tech startup. Python, TensorFlow, and PyTorch are my playground.','speciality'=>'Deep Learning, Computer Vision','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Pierre Dupont','country'=>'France','flag'=>'🇫🇷','rate'=>42,'rating'=>4.7,'reviews'=>154,'students'=>94,'lessons'=>640,'languages'=>'English, French','badge'=>'rising','bio'=>'AI engineer specialising in LLMs, prompt engineering, and building AI-powered products.','speciality'=>'LLMs, Prompt Engineering','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Hannah Lee','country'=>'South Korea','flag'=>'🇰🇷','rate'=>38,'rating'=>4.9,'reviews'=>248,'students'=>150,'lessons'=>1080,'languages'=>'English, Korean','badge'=>'top_rated','bio'=>'ML engineer who teaches practical AI — not just theory. Build real projects from lesson 1.','speciality'=>'Practical AI, Projects','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Omar Farouk','country'=>'Egypt','flag'=>'🇪🇬','rate'=>28,'rating'=>4.8,'reviews'=>178,'students'=>108,'lessons'=>780,'languages'=>'English, Arabic','badge'=>'super_tutor','bio'=>'Kaggle grandmaster teaching ML competitions, feature engineering, and model optimisation.','speciality'=>'Kaggle, Feature Engineering','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Julia Novak','country'=>'Czech Republic','flag'=>'🇨🇿','rate'=>30,'rating'=>4.6,'reviews'=>96,'students'=>60,'lessons'=>390,'languages'=>'English, Czech','badge'=>null,'bio'=>'Data analyst turned AI educator. I focus on applied AI for business and analytics roles.','speciality'=>'Applied AI, Analytics','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Sanjay Patel','country'=>'India','flag'=>'🇮🇳','rate'=>25,'rating'=>4.7,'reviews'=>132,'students'=>82,'lessons'=>520,'languages'=>'English, Gujarati, Hindi','badge'=>'rising','bio'=>'AI startup founder teaching entrepreneurial AI — how to build and ship AI-powered products.','speciality'=>'AI Products, Startups','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Mia Johansson','country'=>'Sweden','flag'=>'🇸🇪','rate'=>48,'rating'=>4.9,'reviews'=>204,'students'=>124,'lessons'=>880,'languages'=>'English, Swedish','badge'=>'top_rated','bio'=>'Research scientist teaching statistical ML, reinforcement learning, and academic AI writing.','speciality'=>'Statistical ML, RL','availability'=>'weekdays','type'=>'professional'],
            ],
            'science' => [
                ['name'=>'Dr. Claire Adams','country'=>'United Kingdom','flag'=>'🇬🇧','rate'=>40,'rating'=>4.9,'reviews'=>276,'students'=>166,'lessons'=>1240,'languages'=>'English','badge'=>'super_tutor','bio'=>'PhD in Physics from Oxford. I teach physics, chemistry, and biology for A-Levels and university entry.','speciality'=>'Physics, A-Level','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Nathan Brooks','country'=>'United States','flag'=>'🇺🇸','rate'=>32,'rating'=>4.8,'reviews'=>208,'students'=>126,'lessons'=>920,'languages'=>'English','badge'=>'top_rated','bio'=>'Former AP Biology teacher. Now private tutoring for SAT II, AP exams, and college admissions.','speciality'=>'AP Biology, SAT II','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Aanya Sharma','country'=>'India','flag'=>'🇮🇳','rate'=>18,'rating'=>4.7,'reviews'=>148,'students'=>90,'lessons'=>580,'languages'=>'English, Hindi','badge'=>'rising','bio'=>'Chemistry specialist helping students understand organic chemistry intuitively with real examples.','speciality'=>'Organic Chemistry','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Lucas Petit','country'=>'France','flag'=>'🇫🇷','rate'=>28,'rating'=>4.8,'reviews'=>184,'students'=>112,'lessons'=>760,'languages'=>'English, French','badge'=>'top_rated','bio'=>'Nuclear physics researcher turned tutor. Passionate about making complex physics approachable.','speciality'=>'Physics, Thermodynamics','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Mei Lin','country'=>'China','flag'=>'🇨🇳','rate'=>22,'rating'=>4.9,'reviews'=>232,'students'=>140,'lessons'=>1020,'languages'=>'English, Mandarin','badge'=>'super_tutor','bio'=>'Biology and biochemistry tutor with university teaching experience. Clear, structured, and exam-focused.','speciality'=>'Biology, Biochemistry','availability'=>'weekdays','type'=>'professional'],
                ['name'=>'Samuel Osei','country'=>'Ghana','flag'=>'🇬🇭','rate'=>14,'rating'=>4.6,'reviews'=>88,'students'=>54,'lessons'=>355,'languages'=>'English','badge'=>null,'bio'=>'Science teacher helping West African students ace WAEC and IGCSE science papers.','speciality'=>'WAEC, IGCSE','availability'=>'weekends','type'=>'professional'],
                ['name'=>'Fatima Al-Zahra','country'=>'Morocco','flag'=>'🇲🇦','rate'=>16,'rating'=>4.7,'reviews'=>112,'students'=>68,'lessons'=>445,'languages'=>'English, Arabic, French','badge'=>'rising','bio'=>'Chemistry and math tutor. Bilingual sessions available in English, French, or Arabic.','speciality'=>'Chemistry, Physics','availability'=>'flexible','type'=>'professional'],
                ['name'=>'Erik Andersen','country'=>'Denmark','flag'=>'🇩🇰','rate'=>36,'rating'=>4.8,'reviews'=>176,'students'=>106,'lessons'=>720,'languages'=>'English, Danish','badge'=>'top_rated','bio'=>'Environmental scientist teaching ecology, climate science, and environmental chemistry.','speciality'=>'Ecology, Climate Science','availability'=>'weekdays','type'=>'professional'],
            ],
            'languages' => [
                ['name'=>'Yuki Tanaka','country'=>'Japan','flag'=>'🇯🇵','rate'=>26,'rating'=>4.9,'reviews'=>292,'students'=>176,'lessons'=>1340,'languages'=>'Japanese, English','badge'=>'super_tutor','bio'=>'Native Japanese speaker certified in teaching Japanese as a foreign language. JLPT N1–N5 specialist.','speciality'=>'Japanese, JLPT','availability'=>'flexible','type'=>'native'],
                ['name'=>'Léa Martin','country'=>'France','flag'=>'🇫🇷','rate'=>24,'rating'=>4.8,'reviews'=>218,'students'=>132,'lessons'=>960,'languages'=>'French, English, Spanish','badge'=>'top_rated','bio'=>'Native French tutor with 6 years of experience. DELF/DALF and conversational French for all levels.','speciality'=>'French, DELF','availability'=>'weekdays','type'=>'native'],
                ['name'=>'Ekaterina Sokolova','country'=>'Russia','flag'=>'🇷🇺','rate'=>20,'rating'=>4.7,'reviews'=>152,'students'=>92,'lessons'=>600,'languages'=>'Russian, English','badge'=>'rising','bio'=>'Russian language tutor — from Cyrillic alphabet to advanced grammar. Patient and methodical approach.','speciality'=>'Russian, Cyrillic','availability'=>'weekends','type'=>'native'],
                ['name'=>'Kim Min-jun','country'=>'South Korea','flag'=>'🇰🇷','rate'=>22,'rating'=>4.8,'reviews'=>186,'students'=>112,'lessons'=>800,'languages'=>'Korean, English','badge'=>'top_rated','bio'=>'TOPIK certified Korean tutor. K-drama Korean, TOPIK exam prep, and business Korean available.','speciality'=>'Korean, TOPIK','availability'=>'flexible','type'=>'native'],
                ['name'=>'Amira Oussama','country'=>'Tunisia','flag'=>'🇹🇳','rate'=>18,'rating'=>4.9,'reviews'=>226,'students'=>136,'lessons'=>1000,'languages'=>'Arabic, English, French','badge'=>'super_tutor','bio'=>'MSA and Darija Arabic tutor. I teach formal Arabic for exams and spoken Arabic for real communication.','speciality'=>'Arabic, MSA','availability'=>'weekdays','type'=>'native'],
                ['name'=>'Giovanni Esposito','country'=>'Italy','flag'=>'🇮🇹','rate'=>20,'rating'=>4.6,'reviews'=>94,'students'=>58,'lessons'=>380,'languages'=>'Italian, English, Spanish','badge'=>null,'bio'=>'Italian language and culture tutor. Conversational Italian and Italian for travel enthusiasts.','speciality'=>'Italian, Conversational','availability'=>'weekends','type'=>'native'],
                ['name'=>'Hina Hayashi','country'=>'Japan','flag'=>'🇯🇵','rate'=>24,'rating'=>4.7,'reviews'=>128,'students'=>78,'lessons'=>510,'languages'=>'Japanese, English','badge'=>'rising','bio'=>'Manga and anime lover who teaches Japanese through pop culture — learning that doesn\'t feel like studying.','speciality'=>'Japanese, Pop Culture','availability'=>'flexible','type'=>'native'],
                ['name'=>'Klara Novotná','country'=>'Czech Republic','flag'=>'🇨🇿','rate'=>16,'rating'=>4.8,'reviews'=>164,'students'=>100,'lessons'=>680,'languages'=>'Czech, Slovak, English','badge'=>'top_rated','bio'=>'Slavic language specialist. Czech and Slovak from A1 to C1 with a structured communicative approach.','speciality'=>'Czech, Slovak','availability'=>'weekdays','type'=>'native'],
            ],
        ];

        foreach ($tutorPool as $slug => $tutors) {
            $subject = Subject::where('slug', $slug)->first();
            if (!$subject) continue;

            foreach ($tutors as $i => $t) {
                Tutor::firstOrCreate(['slug' => \Str::slug($t['name'])], [
                    'subject_id'     => $subject->id,
                    'name'           => $t['name'],
                    'slug'           => \Str::slug($t['name']),
                    'bio'            => $t['bio'],
                    'country'        => $t['country'],
                    'country_flag'   => $t['flag'],
                    'rating'         => $t['rating'],
                    'reviews_count'  => $t['reviews'],
                    'students_count' => $t['students'],
                    'lessons_count'  => $t['lessons'],
                    'hourly_rate'    => $t['rate'],
                    'languages'      => $t['languages'],
                    'tutor_type'     => $t['type'],
                    'speciality'     => $t['speciality'],
                    'availability'   => $t['availability'],
                    'is_verified'    => true,
                    'is_online'      => ($i % 3 === 0),
                    'badge'          => $t['badge'],
                ]);
            }
        }
    }
}

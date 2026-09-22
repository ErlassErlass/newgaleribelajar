<?php

return [
    'coding' => [
        'badge' => 'Future Skills',
        'title' => 'Coding & Artificial Intelligence',
        'subtitle' => 'Building computational thinking logic from basics to Machine Learning for your child\'s future.',
        
        'path_title' => 'Learning Path',
        'path_subtitle' => 'Our curriculum is designed progressively according to children\'s age and cognitive development.',
        
        'levels' => [
            [
                'badge' => 'Primary (7-12 Yrs)',
                'title' => 'Beginner: Visual Coding',
                'desc' => 'Introduction to programming logic using Scratch. Focus on making interactive games, animations, and storytelling without typing code.',
                'features' => ['Sequence & Loops', 'Conditional Logic', 'Variables Basics'],
                'icon' => '🐱',
                'color' => 'kids-blue'
            ],
            [
                'badge' => 'Middle (13-15 Yrs)',
                'title' => 'Intermediate: Python',
                'desc' => 'Transition to Text-Based Coding. Learn Python syntax, basic data structures, and more complex algorithm logic.',
                'features' => ['Python Syntax', 'Functions & Modules', 'Simple Algorithms'],
                'icon' => '🐍',
                'color' => 'kids-yellow'
            ],
            [
                'badge' => 'High (16+ Yrs)',
                'title' => 'Advanced: AI & Web',
                'desc' => 'Applying coding for future technologies: Artificial Intelligence and Web Development (HTML, CSS, JS).',
                'features' => ['Machine Learning Intro', 'Neural Networks', 'API & Databases'],
                'icon' => '🧠',
                'color' => 'kids-mint'
            ]
        ],
        
        'mastery_badge' => 'Skill Development',
        'mastery_title' => 'What They Will Master',
        'mastery_skills' => [
            [
                'title' => 'Logical Thinking',
                'desc' => 'Breaking down large problems into logical steps.',
                'icon' => '🧩',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Creative Confidence',
                'desc' => 'Gaining the courage to express ideas into real digital creations.',
                'icon' => '🎨',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Attention to Detail',
                'desc' => 'Precision in writing code (syntax) and debugging errors.',
                'icon' => '🔍',
                'color' => 'kids-mint'
            ],
            [
                'title' => 'Persistence',
                'desc' => 'Not giving up easily when facing challenges or bugs.',
                'icon' => '🤝',
                'color' => 'kids-pink'
            ]
        ],
        
        'tools_title' => 'Tools & Technologies We Teach',
        'cta_title' => 'Ready to Build Future Programmers?',
        'cta_subtitle' => 'Join 2,000+ other students who have started their digital journey with Erlass.',
        'cta_button' => 'Register for Coding Class'
    ],

    'robotics' => [
        'badge' => 'Engineering & Innovation',
        'title' => 'Robotics & IoT',
        'subtitle' => 'Connecting code to the real world. From basic mechanics to smart Internet of Things (IoT).',
        
        'kits_title' => 'Learning Kits & Modules',
        'kits_subtitle' => 'We use education industry standard hardware to ensure students grasp concepts of electronics and hardware programming.',
        
        'kits' => [
            [
                'title' => 'Robotic Explorer',
                'desc' => 'Focuses on basic electronics concepts, mechanics, and sensors. Students assemble robots that move and respond to physical environments.',
                'features' => ['Electric Circuit Concepts', 'Light & Touch Sensors'],
                'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Micro:bit Learning',
                'desc' => 'A pocket-sized computer that introduces software and hardware interaction. Highly visual with a 5x5 LED matrix.',
                'features' => ['Accelerometer & Compass', 'Radio Communication'],
                'image' => 'https://images.unsplash.com/photo-1555664424-778a1e5e1b48?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Arduino & IoT',
                'desc' => 'Advanced level using C++ language. Creating Smart Home automation systems and Internet of Things projects.',
                'features' => ['C++ Programming Language', 'Wi-Fi Modules (ESP8266)'],
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80',
                'color' => 'kids-pink'
            ]
        ],
        
        'projects_badge' => 'Project Based Learning',
        'projects_title' => '100+ STEM Projects',
        'projects_subtitle' => 'We believe the best way to learn engineering is by building. Our curriculum covers hundreds of practical projects.',
        'projects_link' => 'Contact Us &rarr;',
        
        'project_list' => [
            [
                'title' => 'Smart Garden',
                'desc' => 'Soil moisture sensor automatically waters plants.',
                'icon' => '🌱',
                'color' => 'kids-mint'
            ],
            [
                'title' => 'Smart Trash Bin',
                'desc' => 'Automatic trash bin opens when detecting hands.',
                'icon' => '🗑️',
                'color' => 'kids-blue'
            ],
            [
                'title' => 'Home Automation',
                'desc' => 'Control lights and fans via Smartphone (IoT).',
                'icon' => '🏠',
                'color' => 'kids-yellow'
            ],
            [
                'title' => 'Line Follower',
                'desc' => 'Autonomous robot car following line paths.',
                'icon' => '🚗',
                'color' => 'kids-pink'
            ]
        ]
    ]
];

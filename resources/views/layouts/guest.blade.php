<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ENSA Lost & Found') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }        .input-modern {
            display: block;
            width: 100% !important;
            min-width: 100%;
            padding: 1.75rem 2.5rem;
            color: #374151;
            background-color: white;
            border: 2px solid #e5e7eb;
            border-radius: 1.25rem;
            font-size: 1.125rem;
            line-height: 1.6;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-image: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-sizing: border-box;
            min-height: 4.5rem;
        }          .input-modern:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 8px 12px rgba(0, 0, 0, 0.1);
            outline: none;
            transform: translateY(-2px);
            background-image: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            min-height: 4.5rem;
        }
          .input-modern::placeholder {
            color: #9ca3af;
            font-weight: 400;
            font-size: 1rem;
            opacity: 0.8;
        }
        
        .input-modern:hover {
            border-color: #6b7280;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.08);
        }
        
        .btn-primary {
            display: block;
            width: 100%;
            padding: 0.75rem 1.5rem;
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            background: linear-gradient(to right, #2563eb, #4f46e5);
            transition: all 0.2s ease-in-out;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #1d4ed8, #4338ca);
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #2563eb;
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }
        
        .btn-secondary:hover {
            background-color: #dbeafe;
            border-color: #93c5fd;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 gradient-bg">
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-1/2 -right-1/2 w-96 h-96 bg-white opacity-10 rounded-full animate-float"></div>
            <div class="absolute -bottom-1/2 -left-1/2 w-96 h-96 bg-white opacity-10 rounded-full animate-float" style="animation-delay: 1s;"></div>
        </div>        <div class="relative z-10 w-full max-w-4xl px-4">
            <!-- Logo and Title -->
            <div class="text-center mb-8 animate-fade-in">
                <a href="/" class="inline-block">
                    <div class="mx-auto w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">ENSA Lost & Found</h1>
                    <p class="text-blue-100 text-sm">Tangier Campus</p>
                </a>
            </div>

            <!-- Form Container -->
            <div class="glass-effect rounded-2xl p-8 sm:p-12 shadow-2xl animate-slide-up">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-blue-100 text-sm">
                    © {{ date('Y') }} ENSA Tangier. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>

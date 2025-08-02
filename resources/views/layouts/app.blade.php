<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Notes App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background: #1a1a1a;
            color: #e0e0e0;
        }

        .notes-container {
            padding: 2rem 0;
        }

        .note-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 300px;
            overflow: hidden;
            cursor: pointer;
            transform: translateY(0);
        }

        .note-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.15);
        }

        body.dark-mode .note-card {
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        body.dark-mode .note-card:hover {
            box-shadow: 0 12px 28px rgba(0,0,0,0.4);
        }

        /* Card Color Variants */
        .note-card.color-yellow {
            background: #fff59d;
        }

        .note-card.color-orange {
            background: #ffcc80;
        }

        .note-card.color-pink {
            background: #f8bbd9;
        }

        .note-card.color-purple {
            background: #e1bee7;
        }

        .note-card.color-blue {
            background: #bbdefb;
        }

        .note-card.color-green {
            background: #c8e6c9;
        }

        .note-card.color-red {
            background: #ffcdd2;
        }

        .note-card.color-teal {
            background: #b2dfdb;
        }

        .note-content {
            padding: 1.8rem;
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .note-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #2d3436;
            display: -webkit-box;
            -webkit-line-clamp: 7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .note-actions {
            padding: 1rem 2rem;
            background: rgba(255,255,255,0.25);
            border-top: 1px solid rgba(255,255,255,0.4);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        .btn-custom {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            margin: 0 0.3rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        .btn-view {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(116, 185, 255, 0.4);
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #0984e3 0%, #2d3436 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(116, 185, 255, 0.5);
        }

        .btn-edit {
            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 184, 148, 0.4);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #00a085 0%, #81ecec 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 184, 148, 0.5);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e17055 0%, #d63031 100%);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(225, 112, 85, 0.4);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #d63031 0%, #74b9ff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 112, 85, 0.5);
        }

        .color-option {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .color-option:hover {
            transform: scale(1.2);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .color-option.yellow { background: #fff59d; }
        .color-option.orange { background: #ffcc80; }
        .color-option.pink { background: #f8bbd9; }
        .color-option.purple { background: #e1bee7; }
        .color-option.blue { background: #bbdefb; }
        .color-option.green { background: #c8e6c9; }
        .color-option.red { background: #ffcdd2; }
        .color-option.teal { background: #b2dfdb; }

        .btn-new-note {
            background: #4285f4;
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(66, 133, 244, 0.3);
            transition: all 0.3s ease;
        }

        .btn-new-note:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.4);
            color: white;
            background: #3367d6;
        }

        .navbar-custom {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        body.dark-mode .navbar-custom {
            background: rgba(26,26,26,0.95);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            color: #333 !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        body.dark-mode .navbar-brand {
            color: #e0e0e0 !important;
        }

        .dark-mode-toggle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 1.1rem;
        }

        .dark-mode-toggle:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            transform: scale(1.05);
        }

        body.dark-mode .dark-mode-toggle {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
        }

        body.dark-mode .dark-mode-toggle:hover {
            background: linear-gradient(135deg, #fab1a0 0%, #ffeaa7 100%);
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #333;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        body.dark-mode .page-title {
            color: #e0e0e0;
        }

        .note-count {
            color: #666;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        body.dark-mode .note-count {
            color: #b0b0b0;
        }

        .alert-custom {
            border: none;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .form-control-custom {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1rem;
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            min-height: 200px;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            box-shadow: 0 2px 8px rgba(66, 133, 244, 0.2);
            border-color: #4285f4;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        body.dark-mode .card-custom {
            background: #2d2d2d;
            border: 1px solid #404040;
            color: #e0e0e0;
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        .btn-new-note:hover {
            animation: pulse 2s infinite;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .note-card {
                margin-bottom: 1rem;
                height: 260px;
            }

            .btn-custom {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .color-picker {
                flex-wrap: wrap;
                gap: 0.3rem;
            }

            .color-option {
                width: 16px;
                height: 16px;
            }

            .note-actions {
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
                padding: 0.5rem 1rem;
            }

            .action-buttons {
                display: flex;
                gap: 0.3rem;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .action-buttons {
                gap: 0.2rem;
            }

            .btn-custom {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('notes.index') }}">
                <i class="bi bi-journal-text me-2"></i>Notes
            </a>

            <button id="darkModeToggle" class="dark-mode-toggle" type="button">
                <i class="bi bi-moon-fill"></i>
            </button>
        </div>
    </nav>

    <div class="container notes-container">
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Enhanced JavaScript with dark mode and animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize color picker functionality
            initializeColorPicker();

            // Initialize dark mode functionality
            initializeDarkMode();

            // Add animations to cards
            addCardAnimations();
        });

        function initializeColorPicker() {
            const colorOptions = document.querySelectorAll('.color-option');

            colorOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const newColor = this.getAttribute('data-color');
                    const noteCard = this.closest('.note-card');
                    const noteId = noteCard.getAttribute('data-note-id');

                    // Remove all color classes
                    const colorClasses = ['color-yellow', 'color-orange', 'color-pink', 'color-purple',
                                        'color-blue', 'color-green', 'color-red', 'color-teal'];
                    colorClasses.forEach(cls => noteCard.classList.remove(cls));

                    // Add new color class
                    noteCard.classList.add(newColor);

                    // Save color preference to localStorage
                    localStorage.setItem('note-color-' + noteId, newColor);

                    // Add visual feedback
                    this.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });

            // Load saved colors from localStorage
            document.querySelectorAll('.note-card').forEach(card => {
                const noteId = card.getAttribute('data-note-id');
                const savedColor = localStorage.getItem('note-color-' + noteId);

                if (savedColor) {
                    const colorClasses = ['color-yellow', 'color-orange', 'color-pink', 'color-purple',
                                        'color-blue', 'color-green', 'color-red', 'color-teal'];
                    colorClasses.forEach(cls => card.classList.remove(cls));
                    card.classList.add(savedColor);
                }
            });
        }

        function initializeDarkMode() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const icon = darkModeToggle.querySelector('i');

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme');

            // Apply theme on page load
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                icon.className = 'bi bi-sun-fill';
            }

            darkModeToggle.addEventListener('click', function() {
                body.classList.toggle('dark-mode');

                // Update icon with smooth transition
                icon.style.transform = 'rotate(180deg)';

                setTimeout(() => {
                    if (body.classList.contains('dark-mode')) {
                        icon.className = 'bi bi-sun-fill';
                        localStorage.setItem('theme', 'dark');
                    } else {
                        icon.className = 'bi bi-moon-fill';
                        localStorage.setItem('theme', 'light');
                    }
                    icon.style.transform = 'rotate(0deg)';
                }, 150);
            });
        }

        function addCardAnimations() {
            // Add fade-in animation to note cards
            const noteCards = document.querySelectorAll('.note-card');
            noteCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fade-in');
            });
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CharityHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Full-page gradient background -->
    <div class="min-h-screen py-16 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Large animated card with glass morphism effect -->
            <div class="bg-white/20 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:scale-[1.01]">
                <div class="p-12">
                    <!-- Animated confetti background -->
                    <div class="absolute inset-0 overflow-hidden opacity-20">
                        <div class="confetti"></div>
                        <div class="confetti"></div>
                        <div class="confetti"></div>
                        <div class="confetti"></div>
                        <div class="confetti"></div>
                    </div>

                    <!-- Success animation centerpiece -->
                    <div class="flex justify-center mb-10">
                        <div class="w-32 h-32 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="checkmark w-20 h-20 text-white" viewBox="0 0 52 52">
                                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="currentColor" stroke-width="3"/>
                                <path class="checkmark-check" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Welcome message with bigger text -->
                    <div class="text-center mb-12">
                        <h3 class="text-4xl font-bold text-white mb-4">Welcome back, User!</h3>
                        <div class="inline-block px-6 py-2 bg-white/20 rounded-full backdrop-blur-sm">
                            <span class="text-lg font-semibold text-white">Role: <span class="capitalize">Member</span></span>
                        </div>
                    </div>

                    <!-- Animated dashboard preview -->
                    <div class="mb-14 flex justify-center">
                        <div class="relative w-full max-w-2xl h-48 bg-white/30 rounded-xl backdrop-blur-sm p-4 shadow-inner">
                            <div class="flex space-x-4 mb-4">
                                <div class="w-1/3 h-6 bg-white/50 rounded-full animate-pulse"></div>
                                <div class="w-1/4 h-6 bg-white/40 rounded-full animate-pulse delay-100"></div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-16 bg-gradient-to-r from-green-400/60 to-teal-400/60 rounded-lg animate-pulse delay-75"></div>
                                <div class="h-16 bg-gradient-to-r from-blue-400/60 to-indigo-400/60 rounded-lg animate-pulse delay-150"></div>
                                <div class="h-16 bg-gradient-to-r from-purple-400/60 to-pink-400/60 rounded-lg animate-pulse delay-200"></div>
                            </div>
                            <div class="absolute bottom-4 right-4">
                                <div class="w-24 h-6 bg-white/30 rounded-full animate-pulse delay-300"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Countdown with animated progress circle -->
                    <div class="flex flex-col items-center space-y-8">
                        <div class="relative w-32 h-32">
                            <svg class="w-full h-full" viewBox="0 0 100 100">
                                <!-- Background circle -->
                                <circle cx="50" cy="50" r="45" fill="none" stroke="#ffffff20" stroke-width="8"/>
                                <!-- Progress circle -->
                                <circle id="progress-circle" cx="50" cy="50" r="45" fill="none" stroke="white" stroke-width="8" stroke-linecap="round"
                                        stroke-dasharray="283" stroke-dashoffset="283" transform="rotate(-90 50 50)"/>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span id="timer" class="text-4xl font-bold text-white">3</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-xl text-white/80 mb-4">Preparing your personalized dashboard...</p>
                            <button id="skip-btn" class="px-8 py-3 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
                                Skip & Go Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Checkmark animation */
        .checkmark-circle {
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
        }

        .checkmark-check {
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
        }

        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }

        /* Confetti animation */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #fff;
            opacity: 0;
            animation: confetti 5s ease-in infinite;
        }

        .confetti:nth-child(1) {
            left: 10%;
            animation-delay: 0;
            background-color: #ff0;
        }

        .confetti:nth-child(2) {
            left: 20%;
            animation-delay: 1.5s;
            background-color: #f0f;
        }

        .confetti:nth-child(3) {
            left: 30%;
            animation-delay: 0.5s;
            background-color: #0ff;
        }

        .confetti:nth-child(4) {
            left: 40%;
            animation-delay: 2s;
            background-color: #f00;
        }

        .confetti:nth-child(5) {
            left: 50%;
            animation-delay: 3s;
            background-color: #0f0;
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(500px) rotate(360deg); opacity: 0; }
        }

        /* Pulse animation delays */
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .delay-75 {
            animation-delay: 75ms;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-150 {
            animation-delay: 150ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 3;
            const timerElement = document.getElementById('timer');
            const progressCircle = document.getElementById('progress-circle');
            const skipBtn = document.getElementById('skip-btn');
            let redirectInterval;

            // Start countdown and progress
            function startCountdown() {
                const circumference = 2 * Math.PI * 45;
                const initialOffset = circumference;

                redirectInterval = setInterval(function() {
                    timeLeft--;
                    timerElement.textContent = timeLeft;

                    // Update circle progress
                    const progress = ((3 - timeLeft) / 3) * circumference;
                    progressCircle.style.strokeDashoffset = initialOffset - progress;

                    if (timeLeft <= 0) {
                        clearInterval(redirectInterval);
                        redirect();
                    }
                }, 1000);
            }

            // Redirect function
            function redirect() {
                // Change this URL to where you want to redirect
                window.location.href = "/dashboard";
            }

            // Skip button functionality
            skipBtn.addEventListener('click', function() {
                clearInterval(redirectInterval);
                progressCircle.style.strokeDashoffset = 0;
                timerElement.textContent = '0';
                setTimeout(redirect, 300);
            });

            // Start animations
            setTimeout(startCountdown, 1500); // Wait for checkmark animation to complete
        });
    </script>
</body>
</html>

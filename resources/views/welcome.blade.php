<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
  <!-- Header -->
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i class="ri-checkbox-circle-fill text-sky-600 text-3xl"></i>
        <span class="font-bold text-xl text-sky-700">Tasker</span>
      </div>
      <nav class="hidden md:flex space-x-8">
        <a href="#features" class="text-gray-600 hover:text-sky-600 transition-colors">Features</a>
        <a href="#how-it-works" class="text-gray-600 hover:text-sky-600 transition-colors">How It Works</a>
        <a href="#rewards" class="text-gray-600 hover:text-sky-600 transition-colors">Rewards</a>
      </nav>
      <div class="flex items-center space-x-4">
        <a href="{{route('login')}}" class="text-sky-600 hover:text-sky-700 font-medium">Login</a>
        <a href="{{route('register')}}" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">Sign Up</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="py-16 md:py-24 px-4">
    <div class="container mx-auto max-w-6xl flex flex-col md:flex-row items-center">
      <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Complete Tasks, Earn Amazing Rewards</h1>
        <p class="text-lg text-gray-600 mb-8">Join thousands of users who are turning their productivity into rewards. Complete tasks, earn points, and redeem them for gift cards, discounts, and more!</p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="{{route('register')}}" class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-lg font-medium text-lg transition-colors">Get Started</a>
          <a href="#how-it-works" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-medium text-lg transition-colors text-center">Learn More</a>
        </div>
      </div>
      <div class="md:w-1/2">
        <img src="https://placehold.co/600x400/sky-100/sky-600?text=Task+Rewards" alt="Task Rewards Illustration" class="rounded-lg shadow-lg w-full">
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-16 bg-white px-4">
    <div class="container mx-auto max-w-6xl">
      <h2 class="text-3xl font-bold text-center mb-12">Why Choose Tasker?</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-gray-50 p-6 rounded-lg">
          <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
            <i class="ri-task-line text-sky-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-3">Personalized Tasks</h3>
          <p class="text-gray-600">Get tasks tailored to your skills and interests, making productivity more enjoyable.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-lg">
          <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
            <i class="ri-gift-line text-sky-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-3">Real Rewards</h3>
          <p class="text-gray-600">Earn points that can be redeemed for gift cards, discounts, and exclusive offers.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-lg">
          <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mb-4">
            <i class="ri-community-line text-sky-600 text-2xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-3">Community Challenges</h3>
          <p class="text-gray-600">Join group challenges to boost motivation and earn bonus rewards together.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how-it-works" class="py-16 bg-gray-50 px-4">
    <div class="container mx-auto max-w-6xl">
      <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
      <div class="grid md:grid-cols-4 gap-6">
        <div class="text-center">
          <div class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">1</div>
          <h3 class="text-xl font-semibold mb-2">Sign Up</h3>
          <p class="text-gray-600">Create your free account in less than a minute</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">2</div>
          <h3 class="text-xl font-semibold mb-2">Browse Tasks</h3>
          <p class="text-gray-600">Find tasks that match your skills and interests</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">3</div>
          <h3 class="text-xl font-semibold mb-2">Complete Tasks</h3>
          <p class="text-gray-600">Finish tasks and submit proof of completion</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">4</div>
          <h3 class="text-xl font-semibold mb-2">Earn Rewards</h3>
          <p class="text-gray-600">Redeem your points for amazing rewards</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Rewards Section -->
  <section id="rewards" class="py-16 bg-white px-4">
    <div class="container mx-auto max-w-6xl">
      <h2 class="text-3xl font-bold text-center mb-12">Popular Rewards</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
          <img src="https://placehold.co/400x200/sky-100/sky-600?text=YouTube+Subscribers" alt="Gift Cards" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">YouTube Subscribers</h3>
            <p class="text-gray-600 mb-4">Redeem your points for an increase in growth of your YouTube Channel</p>
            <p class="text-sky-600 font-medium">Starting at 1 subscriber per point</p>
          </div>
        </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
          <img src="https://placehold.co/400x200/sky-100/sky-600?text=YouTube+Video+Likes" alt="Subscriptions" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">YouTube Video Likes</h3>
            <p class="text-gray-600 mb-4">Redeem your points for a higher like count of your videos</p>
            <p class="text-sky-600 font-medium">Starting at 1 like per point</p>
          </div>
        </div>
        <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
          <img src="https://placehold.co/400x200/sky-100/sky-600?text=YouTube+Video+Views" alt="Exclusive Items" class="w-full h-48 object-cover">
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">YouTube Video Views</h3>
            <p class="text-gray-600 mb-4">Redeem your points to boost your video into trending</p>
            <p class="text-sky-600 font-medium">Starting at 100 views per point</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-sky-600 text-white px-4">
    <div class="container mx-auto max-w-4xl text-center">
      <h2 class="text-3xl font-bold mb-6">Ready to Start Earning Rewards?</h2>
      <p class="text-sky-100 text-lg mb-8 max-w-2xl mx-auto">Join thousands of users who are already turning their productivity into real rewards. Sign up today and get 100 bonus points!</p>
      <button onclick="document.getElementById('signup-modal').classList.remove('hidden')" class="bg-white text-sky-700 hover:bg-sky-50 px-8 py-3 rounded-lg font-medium text-lg transition-colors">Create Free Account</button>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-12 px-4 mt-auto">
    <div class="container mx-auto max-w-6xl">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <i class="ri-checkbox-circle-fill text-sky-400 text-3xl"></i>
            <span class="font-bold text-xl text-white">Tasker</span>
          </div>
          <p class="text-gray-400">Complete tasks, earn points, redeem rewards. It's that simple.</p>
        </div>
        <div>
          <h3 class="text-white font-semibold text-lg mb-4">Company</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-sky-400 transition-colors">About Us</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Careers</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Blog</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Press</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-white font-semibold text-lg mb-4">Support</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-sky-400 transition-colors">Help Center</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Contact Us</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Privacy Policy</a></li>
            <li><a href="#" class="hover:text-sky-400 transition-colors">Terms of Service</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-white font-semibold text-lg mb-4">Stay Connected</h3>
          <div class="flex space-x-4 mb-4">
            <a href="#" class="text-gray-400 hover:text-sky-400 transition-colors"><i class="ri-twitter-fill text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-sky-400 transition-colors"><i class="ri-facebook-fill text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-sky-400 transition-colors"><i class="ri-instagram-fill text-2xl"></i></a>
            <a href="#" class="text-gray-400 hover:text-sky-400 transition-colors"><i class="ri-linkedin-fill text-2xl"></i></a>
          </div>
          <p class="text-gray-400">Subscribe to our newsletter for the latest updates and rewards.</p>
        </div>
      </div>
      <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; 2025 Tasker. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Login Modal -->
  <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Login</h2>
        <button onclick="document.getElementById('login-modal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
          <i class="ri-close-line text-2xl"></i>
        </button>
      </div>
      <form>
        <div class="mb-4">
          <label for="login-email" class="block text-gray-700 font-medium mb-2">Email Address</label>
          <input type="email" id="login-email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-colors" placeholder="Enter your email" required>
        </div>
        <div class="mb-6">
          <label for="login-password" class="block text-gray-700 font-medium mb-2">Password</label>
          <input type="password" id="login-password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-colors" placeholder="Enter your password" required>
          <div class="flex justify-end mt-2">
            <a href="#" class="text-sm text-sky-600 hover:text-sky-700">Forgot password?</a>
          </div>
        </div>
        <a href="{{route('login')}}" class="w-full bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-lg font-medium transition-colors">Login</a>
        <div class="mt-4 text-center">
          <a href="{{route('register')}}" class="text-gray-600">Don't have an account?</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>

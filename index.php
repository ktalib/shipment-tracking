<?php
$page_title = "Swift Ship - Home";
include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-accent text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Fast & Reliable Shipping Solutions</h1>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Track your shipments in real-time and enjoy peace of mind with our secure delivery services.</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="track.php" class="bg-white text-primary hover:bg-gray-100 font-bold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                    Track Your Shipment
                </a>
                <a href="create_shipment.php" class="bg-secondary hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                    Create New Shipment
                </a>
            </div>
        </div>
    </section>
    
    <!-- Tracking Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-light p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-6 text-dark">Track Your Shipment</h2>
                <form action="track_result.php" method="GET" class="space-y-4">
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="tracking_number" placeholder="Enter Tracking Number" required
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <button type="submit" class="bg-primary hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Track Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-dark">Why Choose Swift Ship?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-globe text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Global Coverage</h3>
                    <p class="text-gray-600">We deliver to over 200 countries worldwide with reliable tracking and timely delivery.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-secondary"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Secure Shipping</h3>
                    <p class="text-gray-600">Your packages are handled with care and fully insured for peace of mind.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-accent"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Real-time Tracking</h3>
                    <p class="text-gray-600">Monitor your shipments in real-time with detailed updates at every stage.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-dark">How It Works</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                        <i class="fas fa-box text-2xl text-primary"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Create Shipment</h3>
                    <p class="text-gray-600">Fill out the shipment form with sender and recipient details.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                        <i class="fas fa-barcode text-2xl text-primary"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Get Tracking Number</h3>
                    <p class="text-gray-600">Receive a unique tracking number for your shipment.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                        <i class="fas fa-truck text-2xl text-primary"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">We Ship It</h3>
                    <p class="text-gray-600">Our team picks up and delivers your package safely.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                        <i class="fas fa-map-marker-alt text-2xl text-primary"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">4</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-dark">Track & Receive</h3>
                    <p class="text-gray-600">Track your package and receive it at the destination.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-dark">What Our Customers Say</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Swift Ship delivered my package across the country in just 2 days. The tracking was accurate and I could see exactly where my package was at all times."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">John Smith</h4>
                            <p class="text-sm text-gray-500">New York, USA</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"I was impressed by how easy it was to create a shipment and get it delivered internationally. The customer service was excellent when I had questions."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">Maria Garcia</h4>
                            <p class="text-sm text-gray-500">Madrid, Spain</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"As a business owner, I rely on Swift Ship for all my shipping needs. Their bulk shipping options and reliable delivery times have helped my business grow."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-bold">David Chen</h4>
                            <p class="text-sm text-gray-500">Toronto, Canada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>


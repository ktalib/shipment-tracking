<?php
$page_title = "Contact Us - Swift Ship";
include 'includes/header.php';

$success = false;
$error = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // In a real application, you would validate and process the form data here
    // For this example, we'll just simulate a successful submission
    $success = true;
}
?>

<main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-accent text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl mb-0 max-w-3xl mx-auto">We're here to help with all your shipping needs.</p>
        </div>
    </section>
    
    <!-- Contact Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-12">
                    <!-- Contact Information -->
                    <div class="lg:w-2/5">
                        <h2 class="text-2xl font-bold mb-6 text-dark">Get in Touch</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mr-4 shrink-0">
                                    <i class="fas fa-map-marker-alt text-xl text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark mb-1">Our Headquarters</h3>
                                    <p class="text-gray-600">
                                        123 Shipping Lane<br>
                                        Logistics City, LC 12345<br>
                                        United States
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mr-4 shrink-0">
                                    <i class="fas fa-phone text-xl text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark mb-1">Phone</h3>
                                    <p class="text-gray-600">
                                        Customer Service: +1 (555) 123-4567<br>
                                        Business Inquiries: +1 (555) 987-6543
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mr-4 shrink-0">
                                    <i class="fas fa-envelope text-xl text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark mb-1">Email</h3>
                                    <p class="text-gray-600">
                                        Customer Support: support@swiftship.com<br>
                                        General Inquiries: info@swiftship.com
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary/10 w-12 h-12 rounded-full flex items-center justify-center mr-4 shrink-0">
                                    <i class="fas fa-clock text-xl text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark mb-1">Hours of Operation</h3>
                                    <p class="text-gray-600">
                                        Monday - Friday: 8:00 AM - 8:00 PM<br>
                                        Saturday: 9:00 AM - 5:00 PM<br>
                                        Sunday: Closed
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h3 class="font-bold text-dark mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Form -->
                    <div class="lg:w-3/5">
                        <?php if ($success): ?>
                            <div class="bg-green-50 border border-green-200 text-green-800 p-6 rounded-lg mb-8">
                                <h2 class="text-xl font-bold mb-2">Message Sent Successfully!</h2>
                                <p>Thank you for contacting us. We'll get back to you as soon as possible.</p>
                                <div class="mt-4">
                                    <a href="contact.php" class="inline-block bg-primary hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                        Send Another Message
                                    </a>
                                </div>
                            </div>
                        <?php elseif ($error): ?>
                            <div class="bg-red-50 border border-red-200 text-red-800 p-6 rounded-lg mb-8">
                                <h2 class="text-xl font-bold mb-2">Error</h2>
                                <p><?php echo $error; ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!$success): ?>
                            <div class="bg-light p-8 rounded-lg shadow-lg">
                                <h2 class="text-2xl font-bold mb-6 text-dark">Send Us a Message</h2>
                                
                                <form method="POST" action="contact.php" class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="name" class="block text-gray-700 font-medium mb-2">Your Name *</label>
                                            <input type="text" id="name" name="name" required
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-gray-700 font-medium mb-2">Your Email *</label>
                                            <input type="email" id="email" name="email" required
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                                        <input type="tel" id="phone" name="phone"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    </div>
                                    
                                    <div>
                                        <label for="subject" class="block text-gray-700 font-medium mb-2">Subject *</label>
                                        <input type="text" id="subject" name="subject" required
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    </div>
                                    
                                    <div>
                                        <label for="message" class="block text-gray-700 font-medium mb-2">Message *</label>
                                        <textarea id="message" name="message" rows="5" required
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="bg-primary hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                                        Send Message
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Map Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold mb-6 text-dark text-center">Find Us</h2>
                
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <!-- In a real application, you would embed a Google Map or other map service here -->
                    <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center">
                        <p class="text-gray-600 text-lg">Map Placeholder - In a real application, a Google Map would be embedded here</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>


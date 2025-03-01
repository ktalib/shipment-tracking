<?php
$page_title = "Track Shipment - Swift Ship";
include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-accent text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Track Your Shipment</h1>
            <p class="text-xl mb-0 max-w-3xl mx-auto">Enter your tracking number to get real-time updates on your package.</p>
        </div>
    </section>
    
    <!-- Tracking Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-light p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-6 text-dark">Track Your Package</h2>
                <form action="track_result.php" method="GET" class="space-y-6">
                    <div>
                        <label for="tracking_number" class="block text-gray-700 font-medium mb-2">Tracking Number</label>
                        <input type="text" id="tracking_number" name="tracking_number" placeholder="Enter your tracking number" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <p class="text-sm text-gray-500 mt-1">Your tracking number can be found in your shipping confirmation email.</p>
                    </div>
                    
                    <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        Track Now
                    </button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-dark">Frequently Asked Questions</h2>
            
            <div class="max-w-3xl mx-auto space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3 text-dark">Where can I find my tracking number?</h3>
                    <p class="text-gray-600">Your tracking number is provided in your shipping confirmation email. It's also available in your account if you created the shipment while logged in.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3 text-dark">How often is tracking information updated?</h3>
                    <p class="text-gray-600">Tracking information is updated in real-time as your package moves through our network. You can expect multiple updates per day while your package is in transit.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3 text-dark">What if my tracking information isn't updating?</h3>
                    <p class="text-gray-600">If your tracking information hasn't updated in 24 hours, it might be due to a processing delay. If it persists for more than 48 hours, please contact our customer support.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-3 text-dark">Can I track multiple shipments at once?</h3>
                    <p class="text-gray-600">Yes, you can create an account and save all your tracking numbers to monitor multiple shipments from your dashboard.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>


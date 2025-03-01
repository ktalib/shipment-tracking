<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Shipment Tracking'; ?></title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#10B981',
                        accent: '#8B5CF6',
                        dark: '#1F2937',
                        light: '#F9FAFB',
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light min-h-screen flex flex-col">
    <header class="bg-dark text-white shadow-md">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-shipping-fast text-2xl text-secondary"></i>
                <a href="index.php" class="text-xl font-bold">Swift Ship</a>
            </div>
            
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="hover:text-secondary transition">Home</a>
                <a href="track.php" class="hover:text-secondary transition">Track Shipment</a>
                <a href="create_shipment.php" class="hover:text-secondary transition">Create Shipment</a>
                <a href="about.php" class="hover:text-secondary transition">About Us</a>
                <a href="contact.php" class="hover:text-secondary transition">Contact</a>
            </div>
            
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-dark pb-4 px-4">
            <a href="index.php" class="block py-2 hover:text-secondary transition">Home</a>
            <a href="track.php" class="block py-2 hover:text-secondary transition">Track Shipment</a>
            <a href="create_shipment.php" class="block py-2 hover:text-secondary transition">Create Shipment</a>
            <a href="about.php" class="block py-2 hover:text-secondary transition">About Us</a>
            <a href="contact.php" class="block py-2 hover:text-secondary transition">Contact</a>
        </div>
    </header>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>


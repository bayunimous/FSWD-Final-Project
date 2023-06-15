<?php
include 'config.php';

// Fetch slider data from database
$query = mysqli_query($conn, "SELECT * FROM slider");
$sliders = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<section class="slider">
    <div class="slider-container">
        <?php foreach ($sliders as $slider) : ?>
            <div class="slide">
                <img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['caption']; ?>">
                <div class="caption"><?php echo $slider['caption']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Custom CSS for slider -->
<style>
    .slider {
        height: 400px;
        position: relative;
    }

    .slider-container {
        width: 100%;
        height: 100%;
        display: flex;
        overflow: hidden;
    }

    .slide {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .slide img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .slide.active {
        opacity: 1;
    }

    .caption {
        position: absolute;
        bottom: 20px;
        left: 20px;
        color: #fff;
        font-size: 24px;
    }
</style>

<!-- Custom JS for slider -->
<script>
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function showSlide() {
        slides.forEach((slide, index) => {
            if (index === currentSlide) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide();
    }

    setInterval(nextSlide, 5000); // Change slide every 5 seconds
</script>
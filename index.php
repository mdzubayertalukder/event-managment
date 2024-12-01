<!-- index.php header section -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="assets/home.css">
</head>


<?php
include('includes/db.php');
include('includes/header.php');

// Fetch upcoming events
$upcomingEventsSql = "SELECT e.*, u.name as organizer_name 
                      FROM Events e 
                      JOIN Users u ON e.organizer_id = u.id 
                      WHERE e.date > CURDATE() 
                      ORDER BY e.date ASC LIMIT 4";
$upcomingEvents = $conn->query($upcomingEventsSql);

// Fetch running events
$runningEventsSql = "SELECT e.*, u.name as organizer_name 
                     FROM Events e 
                     JOIN Users u ON e.organizer_id = u.id 
                     WHERE DATE(e.date) = CURDATE()";
$runningEvents = $conn->query($runningEventsSql);
?>

<!-- Hero Slider Section -->
<div class="hero-slider">
    <div class="slide">
        <img src="assets/images/slider1.jpg" alt="Event Banner">
        <div class="slide-content">
            <h1>Welcome to Event Management</h1>
            <p>Join our upcoming events and enhance your skills</p>
            <a href="register.php" class="btn-primary">Register Now</a>
        </div>
    </div>
</div>

<!-- Upcoming Events Section -->
<section class="upcoming-events">
    <h2>Upcoming Events</h2>
    <div class="event-grid">
        <?php while($event = $upcomingEvents->fetch_assoc()): ?>
            <div class="event-card">
                <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                <p class="organizer">By <?php echo htmlspecialchars($event['organizer_name']); ?></p>
                <div class="countdown" data-date="<?php echo $event['date']; ?>">
                    <span class="days"></span>d
                    <span class="hours"></span>h
                    <span class="minutes"></span>m
                </div>
                <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn-secondary">Learn More</a>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Running Events Section -->
<section class="running-events">
    <h2>Running Events</h2>
    <div class="event-list">
        <?php while($event = $runningEvents->fetch_assoc()): ?>
            <div class="event-item">
                <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                <p><?php echo htmlspecialchars($event['venue']); ?></p>
                <span class="badge">Live Now</span>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Process Steps Section -->
<section class="process-steps">
    <h2>How It Works</h2>
    <div class="steps-grid">
        <div class="step">
            <div class="step-icon">1</div>
            <h3>Register</h3>
            <p>Create your account and browse events</p>
        </div>
        <div class="step">
            <div class="step-icon">2</div>
            <h3>Participate</h3>
            <p>Attend events and learn new skills</p>
        </div>
        <div class="step">
            <div class="step-icon">3</div>
            <h3>Get Certified</h3>
            <p>Receive certification of completion</p>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <h2>What People Say</h2>
    <div class="testimonial-carousel">
        <div class="testimonial">
            <p>"Great experience with the events. Learned a lot!"</p>
            <cite>John Doe</cite>
        </div>
        <!-- Add more testimonials -->
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter">
    <h2>Stay Updated</h2>
    <form action="subscribe.php" method="POST" class="newsletter-form">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Subscribe</button>
    </form>
</section>

<!-- Footer Section -->
<?php include('includes/footer.php'); ?>

<style>
/* Base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
}

/* Hero Slider */
.hero-slider {
    position: relative;
    height: 500px;
    overflow: hidden;
}

.slide {
    position: relative;
    height: 100%;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slide-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
}

/* Event Cards */
.event-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px;
}

.event-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Process Steps */
.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    padding: 40px 20px;
}

.step {
    text-align: center;
}

.step-icon {
    width: 60px;
    height: 60px;
    background: #2c3e50;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 24px;
}

/* Newsletter */
.newsletter {
    background: #2c3e50;
    color: #fff;
    padding: 40px 20px;
    text-align: center;
}

.newsletter-form {
    max-width: 500px;
    margin: 20px auto;
    display: flex;
    gap: 10px;
}

.newsletter-form input {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 4px;
}

.newsletter-form button {
    padding: 10px 20px;
    background: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>

<script>
// Countdown Timer
function updateCountdown() {
    document.querySelectorAll('.countdown').forEach(countdown => {
        const eventDate = new Date(countdown.dataset.date).getTime();
        const now = new Date().getTime();
        const distance = eventDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        countdown.querySelector('.days').textContent = days;
        countdown.querySelector('.hours').textContent = hours;
        countdown.querySelector('.minutes').textContent = minutes;
    });
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
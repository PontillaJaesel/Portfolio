<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "All fields are required!";
    } elseif ($username === "admin" && $password === "1234") {
        $_SESSION['username'] = $username;
        header("Location: template.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}

if (isset($_SESSION['username'])) {
    include 'data.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume Project</title>
    <link rel="stylesheet" href="resume.css">
</head>

<body class="<?php echo isset($_SESSION['username']) ? 'resume-page' : 'login-page'; ?>">

    <!-- Gradient & blur layers (used for both login & resume) -->
    <img class="image-gradient" src="gradient.png" alt="gradient">
    <div class="layer-blur"></div>

    <?php if (!isset($_SESSION['username'])): ?>
        <!-- Login Page -->
        <div class="login-container">
            <h2>Login</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username"><br><br>
                <input type="password" name="password" placeholder="Password"><br><br>
                <button type="submit">Login</button>
            </form>
            <p class="error"><?php echo $error; ?></p>
        </div>

    <?php else: ?>
        <!-- Resume Page -->
        <div class="container resume-container">
        <!-- LEFT COLUMN -->
        <div class="left-column">
            <img src="profile.jpg" alt="Profile Photo" class="profile-img">
            <h1><?php echo $name; ?></h1>
            <p><strong><?php echo $title; ?></strong></p>
            <p><?php echo $email; ?><br><?php echo $phone; ?><br><?php echo $address; ?></p>

            <div class="profile-buttons">
                <a href="https://github.com/PontillaJaesel" target="_blank" class="profile-btn github-btn">GitHub</a>
                <a href="https://www.linkedin.com/in/jaesel-pontilla-89715333b/" target="_blank" class="profile-btn linkedin-btn">LinkedIn</a>
            </div>

            <hr class="section-divider">

            <h2>Skills</h2>
                <?php foreach ($skills as $skill):
                    $parts = explode(":", $skill, 2);
                ?>
                    <div class="skill-box">
                        <ul>
                            <li>
                                <strong><?php echo $parts[0]; ?>:</strong>
                                <?php if (isset($parts[1])) echo $parts[1]; ?>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; ?>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="right-column">
            <div class="section">
                <h2>Profile</h2>
                <div class="profile-box">
                    <p><?php echo $summary; ?></p>
                </div>
            </div>
            <hr class="section-divider">

            <div class="section">
                <h2>Education</h2>
                <?php foreach ($education as $edu): ?>
                    <div class="edu-box">
                        <p>
                            <strong><?php echo $edu["degree"]; ?></strong> – <?php echo $edu["school"]; ?> (<?php echo $edu["year"]; ?>)
                        </p>
                        <ul>
                            <li>
                                <strong>Relevant Courses:</strong> <?php echo $edu["courses"]; ?>
                            </li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="section-divider">
                
            <div class="section">
                <h2>Organizations</h2>
                <?php foreach ($organizations as $org): ?>
                    <div class="org-box">
                        <p><strong><?php echo $org["name"]; ?></strong></p>
                        <ul class="org-positions">
                            <?php foreach ($org["positions"] as $pos): ?>
                                <li>
                                    <strong><?php echo $pos["role"]; ?></strong> (<?php echo $pos["year"]; ?>)
                                    <ul class="org-details">
                                        <li><?php echo $pos["details"]; ?></li>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="section-divider">

            <div class="section">
                <h2>Experience</h2>
                <?php foreach ($experience as $job): ?>
                    <div class="experience-box">
                        <div class="experience-row">
                            <div class="experience-title">
                                <strong><?php echo $job["position"]; ?></strong><br>
                                <?php echo $job["company"]; ?><br>
                                <small><?php echo $job["year"]; ?></small>
                            </div>
                            <div class="experience-details">
                                <?php echo $job["details"]; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="section-divider">

            <div class="section">
                <h2>Projects</h2>
                <?php foreach ($projects as $project): ?>
                    <div class="project-box">
                        <div class="experience-row">
                            <div class="experience-title">
                                <strong><?php echo $project["title"]; ?></strong><br>
                                <?php echo $project["organization"]; ?><br>
                                <small><?php echo $project["year"]; ?></small>
                            </div>
                            <div class="experience-details">
                                <?php echo $project["details"]; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="section-divider">
    

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
    <?php endif; ?>

</body>
</html>

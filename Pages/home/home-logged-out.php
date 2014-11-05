<?php
    require_once('/var/www/latin/config.php');
    sro('/Includes/mysql.php');
    sro('/Includes/session.php');
    sro('/Includes/functions.php');
?>
<header>
    <h1>Welcome</h1>
</header>
<article>
    <p>
        Welcome to Sassy's Online Latin Quiz, created by Nick Scheel and website design by Alex Scheel.<br><br>
        <button class="large" onclick="window.location.href='/latin/links.php';">Latin websites</button><br>
        <button class="large" onclick="window.location.href='/latin/sentence.php';">Sentence Viewer</button><br>
        <button class="large" onclick="window.location.href='/latin/dictionary2.php';">Dictionary</button><br>

        Please <a href="/latin/login.php">log in</a> to save scores.
    </p>
</article>

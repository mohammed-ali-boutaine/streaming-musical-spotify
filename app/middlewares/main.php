
<?php


function authMiddleware($next) {
    if (!isset($_SESSION['user'])) {
        die("Unauthorized");
    }
    return $next();
}

// Using middleware in routing
authMiddleware(function() {
    echo "Welcome to your dashboard!";
});

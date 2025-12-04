<?php
/**
 * Security Helper Functions
 * Provides input validation, sanitization, and CSRF protection
 */

// Start session if not already started.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Safely get and sanitize GET parameter
 * @param string    $key     The parameter key
 * @param int        $filter  The filter to apply (default: FILTER_SANITIZE_SPECIAL_CHARS)
 * @param mixed      $default Default value if parameter doesn't exist
 * @return mixed Sanitized value or default
 */
function get_input($key, $filter = FILTER_SANITIZE_SPECIAL_CHARS, $default = null)
{
    if (isset($_GET[$key]) === false) {
        return $default;
    }
    return filter_var($_GET[$key], $filter);
}
/**
 * Safely get and sanitize POST parameter
 * @param string $key The parameter key
 * @param int $filter The filter to apply (default: FILTER_SANITIZE_SPECIAL_CHARS)
 * @param mixed $default Default value if parameter doesn't exist
 * @return mixed Sanitized value or default
 */
function post_input($key, $filter = FILTER_SANITIZE_SPECIAL_CHARS, $default = null)
{
    if (isset($_POST[$key]) === false) {
        return $default;
    }
    return filter_var($_POST[$key], $filter);
}

/**
 * Validate and sanitize an ID parameter
 * @param mixed $id The ID to validate
 * @return int|null Valid integer ID or null
 */
function validate_id($id)
{
    if ($id === null || $id === '') {
        return null;
    }
    $filtered = filter_var($id, FILTER_VALIDATE_INT);

    if ($filtered === false || $filtered < 1) {
        return null;
    }

    return $filtered;
}

/**
 * Generate CSRF token and store in session
 * @return string The generated token
 */
function generate_csrf_token()
{
    if (isset($_SESSION['csrf_token']) === false) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 * @param string $token The token to verify
 * @return bool True if valid, false otherwise
 */
function verify_csrf_token($token)
{
    if (isset($_SESSION['csrf_token']) === false) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get CSRF token from POST or GET
 * @return string|null The token or null
 */
function get_csrf_token()
{
    return post_input('csrf_token', FILTER_SANITIZE_SPECIAL_CHARS)
        ?? get_input('csrf_token', FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Verify CSRF token from request and redirect on failure
 * @param string $redirect_url Where to redirect on failure
 * @return void
 */
function verify_csrf_or_redirect($redirect_url = 'index.php')
{
    $token = get_csrf_token();

    if (verify_csrf_token($token) === false) {
        redirect($redirect_url);
    }
}

/**
 * Generate CSRF token hidden input field
 * @return string HTML input field
 */
function csrf_field()
{
    $token = generate_csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

/**
 * Generate CSRF token URL parameter
 * @return string URL parameter string
 */
function csrf_param()
{
    $token = generate_csrf_token();
    return 'csrf_token=' . urlencode($token);
}

/**
 * Redirect to a URL and exit
 * @param string $url The URL to redirect to
 * @return void
 */
function redirect($url)
{
    header("Location: $url");
    exit();
}

/**
 * Require user to be logged in
 * @param string $login_path Path to login page
 * @return void
 */
function require_login($login_path = '../auth/login.php')
{
    if (isset($_SESSION['usuario']) === false) {
        redirect($login_path);
    }
}

/**
 * Get the currently logged in user
 * @return string|null User name or null if not logged in
 */
function get_logged_in_user()
{
    return $_SESSION['usuario'] ?? null;
}

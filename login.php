<?php
session_start();
interface UserRepositoryInterface {
    public function getUserByUsername($username);
}

class UserRepository implements UserRepositoryInterface {
    public function getUserByUsername($username) {
        // Connect to the database and fetch user by username
        // Return the user data or null if not found
       // Database connection details
        $host = 'localhost';
        $port = 3306;
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'cse1';

        // Create a new PDO instance
        $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUsername, $dbPassword);

        // Prepare the SQL statement
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        // Bind the parameter and execute the query
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the user data or null if not found
        return $user ? $user : null;
    }
}

interface AuthenticationServiceInterface {
    public function authenticate($username, $password);
}

class AuthenticationService implements AuthenticationServiceInterface {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function caesar_cip($password) {
        
        $result = '';

        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];

            if (ctype_alpha($char)) {
                $asciiOffset = ord(ctype_upper($char) ? 'A' : 'a');
                $result .= chr(($asciiOffset + ord($char) + 13) % 26 + $asciiOffset);
            } else {
                $result .= $char;
            }
    }

    return $result;
    }
    
    public function authenticate($username, $password) {
        $user = $this->userRepository->getUserByUsername($username);

        if ($user && $user['password'] === md5($this->caesar_cip($password))) {
            return true;
        }

        return false;
    }
}


class LoginController {
    private $authenticationService;

    public function __construct(AuthenticationServiceInterface $authenticationService) {
        $this->authenticationService = $authenticationService;
    }

    public function login($username, $password) {
        if ($this->authenticationService->authenticate($username, $password)) {
            // Redirect to the successful login page
            $_SESSION['username'] = $username;
            header("Location: success.php");
            exit();
        } else {
            // Redirect back to the login page with an error message
            header("Location: index.php?error=true");
            // header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
            exit();
        }
    }
}

// Usage example
$userRepository = new UserRepository();
$authenticationService = new AuthenticationService($userRepository);
$loginController = new LoginController($authenticationService);

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginController->login($username, $password);
}

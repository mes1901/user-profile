<?php

declare(strict_types=1);

class User
{
    /**
     * Identify database connection.
     * @var object
     */
    private $db;

    /**
     * Initialize database connection from controller.
     * @var object
     */
    public function __construct(object $db)
    {
        $this->db = $db;
    }

    /**
     * Insert data of already registered user.
     * Hash password to store it in database.
     * @var array
     * @return string
     */
    public function addNewUser(array $data): string
    {
        $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($data['email'], FILTER_SANITIZE_STRING);
        $firstName = filter_var($data['firstName'], FILTER_SANITIZE_STRING);
        $lastName = filter_var($data['lastName'], FILTER_SANITIZE_STRING);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
        $gender = !empty($data['gender']) ? filter_var($data['gender'], FILTER_SANITIZE_STRING) : null;
        $avatar = !empty($data['avatar']) ? filter_var($data['avatar'], FILTER_SANITIZE_STRING) : null;
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = 'INSERT INTO users (username, first_name, last_name, email, password, gender, avatar) ' .
            'VALUES (?, ?, ?, ?, ?, ?, ?)';
        $result = $this->db->prepare($sql);

        try {
            $response = $result->execute([$username, $firstName, $lastName, $email, $hash, $gender, $avatar]);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }

        return (string)$response;
    }

    /**
     * Check register data if valid and generate errors block.
     * @var array
     * @return array
     */
    public function checkRegisterData(array $data): array
    {
        $errors = [];
        if ($this->isUsernameExist($data['username'])) {
            $errors[] = "Such username already exist";
        }
        if ($this->isEmailExist($data['email'])) {
            $errors[] = "Such email already exist";
        }
        if (!$this->checkUsername($data['username'])) {
            $errors[] = "Incorrect username";
        }
        if (!$this->checkEmail($data['email'])) {
            $errors[] = "Incorrect email";
        }
        if (!$this->checkFirstName($data['firstName'])) {
            $errors[] = "Incorrect First Name";
        }
        if (!$this->checkLastName($data['lastName'])) {
            $errors[] = "Incorrect Last Name";
        }
        if (!$this->checkPassword($data['password'])) {
            $errors[] = "Incorrect password";
        }
        if ($data['password'] !== $data['passwordConfirm']) {
            $errors[] = "Passwords don't match";
        }

        return $errors;
    }

    /**
     * Get user data for profile page.
     * @return array
     */
    public function getUserData(): array
    {
        $id = $this->userId();
        $sql = 'SELECT * FROM users WHERE id = ?';
        $result = $this->db->prepare($sql);
        $result->execute([$id]);

        return $result->fetch();
    }

    /**
     * Get current user id.
     * @return int
     */
    public function userId(): int
    {
        return $_SESSION['user'] ?? (int)false;
    }

    /**
     * Check if user exist in the database.
     * @param string
     * @param string
     * @return int
     */
    public function isUserExist(string $username, string $password): int
    {
        $sql = 'SELECT id, password FROM users WHERE username = ?';
        $result = $this->db->prepare($sql);
        $result->execute([$username]);

        $user = $result->fetch();

        return ($user && password_verify($password, $user['password'])) ? $user['id'] : (int)false;
    }

    /**
     * Check if username exist in the database.
     * @param string
     * @return bool
     */
    public function isUsernameExist(string $username): bool
    {
        $sql = 'SELECT 1 FROM users WHERE username = ? LIMIT 1';
        $result = $this->db->prepare($sql);

        $result->execute([$username]);

        return (bool)$result->fetchColumn();
    }

    /**
     * Check if email exist in the database.
     * @param string
     * @return bool
     */
    public function isEmailExist(string $email): bool
    {
        $sql = 'SELECT 1 FROM users WHERE email = ? LIMIT 1';
        $result = $this->db->prepare($sql);

        $result->execute([$email]);

        return (bool)$result->fetchColumn();
    }

    /**
     * Email validation.
     * @param string
     * @return bool
     */
    public function checkEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * Username validation.
     * @param string
     * @return bool
     */
    public function checkUsername(string $username): bool
    {
        $regEx = '/^[a-zA-Z0-9]{3,20}$/';
        return (bool)preg_match($regEx, $username);
    }

    /**
     * First name validation.
     * @param string
     * @return bool
     */
    public function checkFirstName(string $firstName): bool
    {
        $regEx = '/^[a-zA-Z]{3,20}$/';
        return (bool)preg_match($regEx, $firstName);
    }

    /**
     * Last name validation.
     * @param string
     * @return bool
     */
    public function checkLastName(string $lastName): bool
    {
        $regEx = '/^[a-zA-Z_-]{3,20}$/';
        return (bool)preg_match($regEx, $lastName);
    }

    /**
     * Validate password length.
     * @param string
     * @return boolean
     */
    public function checkPassword(string $password): bool
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Checking if current user is log in or not.
     * @return boolean
     */
    public function isGuest(): bool
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Auth user after login.
     * @param int
     * @return void
     */
    public function auth(int $id): void
    {
        $_SESSION['user'] = $id;
    }

    /**
     * Check uploaded file by extension and size and save it to dir.
     * @param array
     * @param string
     * @return array
     */
    public function upload(array $file, string $username): array
    {
        $data['errors'] = [];
        $path = ROOT . '/public/images/user_images/';
        $types = array('image/gif', 'image/png', 'image/jpeg');
        if (!empty($file)) {
            $img = $file['name'];
            $tmp = $file['tmp_name'];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if (!in_array($file['type'], $types)) {
                $data['errors'][] = 'Wrong image extension';
            }
            if ($file['size'] > 1000000) {
                $data['errors'][] = 'File size must be low then 1 Mb';
            }
            if (count($data['errors']) > 0) {
                return $data;
            }
            $fileName = strtolower($username) . '.' . $ext;
            $fullPath = $path . $fileName;
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            if (!move_uploaded_file($tmp, $fullPath)) {
                $data['errors'][] = 'Something wrong with image uploading. Try again.';

                return $data;
            }
            $data['fileName'] = $fileName;
        }

        return $data;
    }
}
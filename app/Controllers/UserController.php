<?php

declare(strict_types=1);

class UserController extends Controller
{
    /**
     * @var object
     * @var object
     */
    private $user;
    private $lang;

    /**
     * Instantiate User class
     * to execute database queries.
     * Instantiate Language class to render the forms.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = new User($this->db);
        $this->lang = new Language();
    }

    /**
     * Render register form.
     * @return void
     */
    public function registerFormAction(): void
    {
        if (!$this->user->isGuest()) {
            header("Location: /");
        }
        $data = $this->lang->getData('register_view');
        $this->render('register_view', $data);
    }

    /**
     * Render login form.
     * @return void
     */
    public function loginFormAction(): void
    {
        if ($this->user->isGuest()) {
            $data = $this->lang->getData('login_view');
            $this->render('login_view', $data);
        }

        header("Location: /");
    }

    /**
     * Render profile form.
     * @return void
     */
    public function profileAction(): void
    {
        if (!$this->user->isGuest()) {
            $data['user'] = $this->user->getUserData();
            $commonData = $this->lang->getData('profile_view');
            $this->render('profile_view', array_merge($data, $commonData));
        }

        header("Location: /user/registerForm");
    }

    /**
     * Checking registration data and redirecting the user back
     * if the data is incorrect.
     * Adding user data to the database if validation successful.
     * Upload file and set to the database.
     * @return bool
     */
    public function registrationAction(): bool
    {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'password' => $_POST['password'],
            'passwordConfirm' => $_POST['confirmPassword'],
            'gender' => $_POST['gender'],
            'avatar' => $_FILES['avatar'],
        ];

        $image = [];

        if (!empty($data['avatar'])) {
            $image = $this->user->upload($data['avatar'], $data['username']);
        }

        if (count($image['errors']) > 0) {
            echo json_encode($image['errors']);

            return false;
        }

        if (count($response = $image['errors']) > 0) {
            echo json_encode($response);

            return true;
        }

        $data['avatar'] = $image['fileName'];

        if (count($response = $this->user->checkRegisterData($data)) > 0) {
            echo json_encode($response);

            return true;
        }

        if (!(bool)$this->user->addNewUser($data)) {
            $response[] = 'Something went wrong. Try again.';
            echo json_encode($response);

            return true;
        }

        echo json_encode($response);

        return true;
    }

    /**
     * Checking login values and redirecting the user back
     * if the data is incorrect.
     * Checking if the user exists in the database.
     * @return bool
     */
    public function loginAction(): bool
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $response = [];

        if (!$userId = $this->user->isUserExist($username, $password)) {
            $response[] = 'Such user don\'t exist. Incorrect username or password';

        }
        $this->user->auth($userId);
        echo json_encode($response);

        return true;
    }

    /**
     * User logout and redirect to home page
     * @return void
     */
    public function logoutAction(): void
    {
        unset($_SESSION["user"]);

        $data = $this->lang->getData('login_view');
        $this->render('login_view', $data);
    }

    /**
     * Set language chosen by the user.
     * @param string
     * @return bool
     */
    public function languageAction(string $lang): bool
    {
        $this->lang->setLang($lang);
        echo json_encode('success');

        return true;
    }
}
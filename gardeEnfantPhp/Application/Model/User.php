<?php


class User
{
    private $id,
        $name,
        $firstname,
        $email,
        $phone,
        $pwd,
        $valid,
        $roles_id,
        $verif;

    public function __construct()
    {
    }


    public static function register()
    {
        if (isset($_POST['register'])) {


            $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');


            $error = array();
            $success = false;


            $email = trim(strip_tags($_POST['email']));
            $phone = trim(strip_tags($_POST['phone']));
            $name = trim(strip_tags($_POST['name']));
            $firstname = trim(strip_tags($_POST['firstname']));
            $pwd = trim(strip_tags($_POST['pwd']));
            $pwd_v = trim(strip_tags($_POST['pwd_v']));
            $options = ['cost' => 12,];

            $verif = random_bytes(5);
            $verif = bin2hex($verif);


            if (!empty($email)) {
                $sql = "SELECT email FROM user WHERE email = :email";
                $query = $bdd->prepare($sql);
                $query->bindValue(':email', $email, PDO::PARAM_STR);
                $query->execute();
                $loginEmail = $query->fetch();
                if (!empty($loginEmail)) {
                    $error['1'] = 'Cet email est déjà utilisé';
                }
            } else {
                $error['2'] = 'Veuillez entrer un email';
            }

            if (empty($phone)){
                $error['3'] = 'Veuillez entrer un numéro de téléphone.';
            }

            if (!empty($name)) {
                if (strlen($name) < 3) {
                    $error['4'] = 'Votre nom doit comprendre au minium 3 caractères.';
                } elseif (strlen($name) > 255) {
                    $error['5'] = 'Votre nom doit comprendre au maximum 255 caractères.';
                }
            } else {
                $error['6'] = 'Veuillez indiquez votre nom';
            }


            if (!empty($firstname)) {
                if (strlen($firstname) < 3) {
                    $error['7'] = 'Votre prénom doit comprendre au minium 3 caractères.';
                } elseif (strlen($firstname) > 255) {
                    $error['8'] = 'Votre prénom doit comprendre au maximum 255 caractères.';
                }
            } else {
                $error['9'] = 'Veuillez indiquez votre prénom';
            }


            if (!empty($pwd)) {
                if (strlen($pwd) < 6) {
                    $error['10'] = 'Le mot de passe est trop court. (Minimum 6 caractères)';
                } elseif (strlen($pwd) > 255) {
                    $error['11'] = 'Le mot de passe est trop long. (Maximum 255 caractères)';
                }
            } else {
                $error['12'] = 'Veuillez renseigner un mot de passe';
            }


            if (!empty($pwd_v)) {
                if ($pwd_v !== $pwd) {
                    $error['13'] = 'Les mots de passes renseignés ne correspondent pas';
                }
            } else {
                $error['14'] = 'Veuillez remplir le champ de confirmation de mot de passe';
            }



            if (count($error) == 0){

                $success = true;
                $pass_hache = password_hash($pwd, PASSWORD_BCRYPT, $options);
                $sql = "INSERT INTO user (id,name,firstname,email,phone,pwd,valid,roles_id,verif) VALUES(NULL, :name,:firstname, :email, :phone, :pwd,0,2, :verif)";
                $query = $bdd->prepare($sql);
                $query->bindValue(':name',$name, PDO::PARAM_STR);
                $query->bindValue(':firstname',$firstname, PDO::PARAM_STR);
                $query->bindValue(':email',$email, PDO::PARAM_STR);
                $query->bindValue(':phone',$phone, PDO::PARAM_STR);
                $query->bindValue(':name',$name, PDO::PARAM_STR);
                $query->bindValue(':pwd',$pass_hache, PDO::PARAM_STR);
                $query->bindValue(':verif',$verif, PDO::PARAM_STR);
                $query->execute();

            }else {
                for ($i = 1; $i <= 13; $i++) {
                    if (!empty ($error[$i])) {
                        echo $error[$i] . '<br>';
                    }
                }
            }


            $request2 = "SELECT * FROM user WHERE email='$email'";
            $cle = $bdd->query($request2)->fetchColumn(8);

            mail($email, 'inscription', $cle);


            echo "Inscription réussi, vérifiez vos emails et cliquez sur ce lien pour valider votre compte<br>";
            echo "<a href='".PUB_PATH."/User/validation'>Validation</a>";


        }
    }

    public function validation(){
        if(isset($_POST['verificationUser'])){
            $email = $_POST['validUser'];
            $cle = $_POST['verifUser'];



            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $requete = "SELECT * FROM user WHERE email='$email'";
            $result = $db->query($requete)->fetchColumn(8);




            if($cle != $result){
                echo "Impossible d'activer le compte";
            } else {
                $sql = "UPDATE user SET valid=1 WHERE email='$email'";
                $stm = $db->prepare($sql)->execute();

                echo "Votre compte a été validé";
            }
        }
    }

    public static function loginUser(){

        if (isset($_POST['signin'])) {

            $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $email= $_POST['email'];
            $password = $_POST['pwd'];


            $req = $bdd->prepare("SELECT * FROM user WHERE email ='$email' ");
            $req->execute();
            $hash = $req->fetchColumn(5);

            if(password_verify($password,$hash)){
                $log = $bdd->query("SELECT * FROM user WHERE email='$email' AND pwd='$hash'")->fetchAll(PDO::FETCH_ASSOC);
            } else{
                echo 'Erreur';
                exit;
            }

            foreach($log as $value){
                $id = $value['id'];
                $name = $value['name'];
                $firstname = $value['firstname'];
                $emailUser = $value['email'];
                $phone = $value['phone'];
                $valid = $value['valid'];
                $role = $value['roles_id'];
            }


            if ($valid==1){
                echo "Connexion réussi";
                session_start();
                $_SESSION['login'] = 1;
                $_SESSION['loginUser'] = 1;
                $_SESSION['nomUser'] = $name;
                $_SESSION['firstnameUser'] = $firstname;
                $_SESSION['role'] = $role;
                $_SESSION['idUser'] = $id;
                $_SESSION['emailUser'] = $emailUser;
                $_SESSION['phoneUser'] = $phone;

                if($_SESSION['role']==1){
                    $_SESSION['Admin']=1;
                }


                ?>
                <SCRIPT LANGUAGE="JavaScript">
                    document.location.href="<?= PUB_PATH?>/User/profil"
                </SCRIPT>

                <?php


            } else {
                echo "Votre compte n'a pas été validé<br>";
                echo "<a href='".PUB_PATH."/User/validation'>Validation</a>";
            }

        }


    }

    public static function EditProfil(){



        $user_id = $_SESSION['idUser'];
        $e_name = trim(strip_tags($_POST["user_name"]));
        $e_firstname=trim(strip_tags($_POST["user_firstname"]));
        $e_email = $_POST['user_email'];
        $e_phone=trim(strip_tags($_POST['user_phone']));



        $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
        $req= $bdd->prepare("UPDATE user SET name='$e_name', firstname='$e_firstname',email='$e_email', phone='$e_phone'  WHERE id ='$user_id'");
        $req->execute();

        ?>
        <SCRIPT LANGUAGE="JavaScript">
            document.location.href="<?=PUB_PATH?>/Professionnels/logout"
        </SCRIPT>

        <?php



    }

    public static function ShowChild()
    {

        $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
        $user_id1 = $_SESSION['idUser'];
        $req = $bdd->prepare("SELECT * FROM children WHERE user_id1 = '$user_id1'");
        $req->execute();


        $result = $req->fetchAll();

        $_SESSION['children']= $result;

    }

    public static function EditChild(){

        $userid = $_SESSION['idUser'];
        $e_childname = trim(strip_tags($_POST["child_name"]));
        $e_childfirstname= trim(strip_tags($_POST["child_firstname"]));
        $e_childbirthday=trim(strip_tags($_POST['child_birthday']));
        $e_childdescription=trim(strip_tags($_POST['description']));



        $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
        $req= $bdd->prepare("UPDATE children SET name='$e_childname', firstname='$e_childfirstname',birthday='$e_childbirthday', description='$e_childdescription'  WHERE user_id1 ='$userid' AND birthday='$e_childbirthday'");
        $req->execute();

    }

    public static function AddChild(){


        $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

        $user_id = $_SESSION['idUser'];
        $prenom = trim(strip_tags($_POST['child_name']));
        $nom = trim(strip_tags($_POST['child_firstname']));
        $birthday = trim(strip_tags($_POST['child_birthday']));
        $description= trim(strip_tags($_POST['child_description']));


        $sql = "INSERT INTO children (id,name,firstname,birthday,description,user_id1) VALUES(NULL, :name,:firstname, :birthday, :description, '$user_id')";
        $query = $bdd->prepare($sql);
        $query->bindValue(':name',$prenom, PDO::PARAM_STR);
        $query->bindValue(':firstname',$nom, PDO::PARAM_STR);
        $query->bindValue(':birthday',$birthday, PDO::PARAM_STR);
        $query->bindValue(':description',$description, PDO::PARAM_STR);
        $query->execute();


    }

    public static function Planning_has_child()
    {

        $bdd = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
        $id_user = $_SESSION['idUser'];

        $req= $bdd->prepare("SELECT * FROM planning INNER JOIN children_has_professionnels ON (SELECT id FROM children WHERE user_id1= '$id_user')=children_has_professionnels.children_id AND children_has_professionnels.planning_id=planning.id");
        $req->execute();
        $result = $req->fetchAll();

        $_SESSION['planning'] = $result;
    }







    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }



    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getRolesId()
    {
        return $this->roles_id;
    }

    /**
     * @param mixed $roles_id
     */
    public function setRolesId($roles_id)
    {
        $this->roles_id = $roles_id;
    }

    /**
     * @return mixed
     */
    public function getVerif()
    {
        return $this->verif;
    }

    /**
     * @param mixed $verif
     */
    public function setVerif($verif)
    {
        $this->verif = $verif;
    }
}







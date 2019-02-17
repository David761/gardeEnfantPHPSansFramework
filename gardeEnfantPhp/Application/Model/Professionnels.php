<?php


class Professionnels extends Framework
{
    private $id,
            $name,
            $email,
            $pwd,
            $valid,
            $phone,
            $address,
            $num_agreement,
            $num_siret,
            $active,
            $price,
            $picture,
            $verif;


    public function __construct()
    {
    }

    public static function register(){
        if(isset($_POST['register'])){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);
            $address = $_POST['address'];
            $agreement = trim($_POST['agreement']);
            $siret = trim($_POST['siret']);
            $price = trim($_POST['price']);
            $picture = $_POST['picture'];



            if($name=="" || $email=="" || $password==""){
                echo "Veuillez remplir tous les champs";
            } else {


                $pwd = password_hash($password, PASSWORD_DEFAULT);
                $verif = random_bytes(5);
                $verif2 = bin2hex($verif);
                $dossier = ROOT . 'public/upload/';
                $fichier = basename($_FILES['picture']['name']);
                $ext = array('jpg', 'gif', 'png', 'jpeg');
                $fichierExt = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

                try {
                    $db = new PDO('mysql:host=172.16.18.128;dbname=childcare', 'joffrey', 'azerty');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



                            $stmt = $db->prepare("INSERT INTO professionnels(name,email,pwd,valid,phone,address,num_agreement,num_siret,active,price,picture,verif)
            VALUES (:name,:email,:pwd,0,:phone,:address,:num_agreement,:num_siret,0,:price,:picture,:verif)");
                            $stmt->bindParam(':name', $name);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':pwd', $pwd);
                            $stmt->bindParam(':phone', $phone);
                            $stmt->bindParam(':address', $address);
                            $stmt->bindParam(':num_agreement', $agreement);
                            $stmt->bindParam(':num_siret', $siret);
                            $stmt->bindParam(':price', $price);
                            $stmt->bindParam(':picture', $_FILES['picture']['name']);
                            $stmt->bindParam(':verif', $verif2);

                            $stmt->execute();
                        }
                    catch
                        (PDOException $e){
                            echo $e->getMessage();
                        }

                if(in_array(strtolower($fichierExt),$ext)){

                    if(move_uploaded_file($_FILES['picture']['tmp_name'], $dossier . $fichier)){
                        echo "Upload bon<br>";
                    }else{
                        echo "echec";
                    }
                }else{
                    echo 'erreur extension';
                }










                $request2 = "SELECT * FROM professionnels WHERE email='$email'";
                $cle = $db->query($request2)->fetchColumn(12);

                mail($email, 'inscription', $cle);


                echo "Inscription réussi, vérifiez vos emails et cliquez sur ce lien pour valider votre compte";
                echo "<a href='".PUB_PATH."/Professionnels/validation'>Validation</a>";

            }
                }



    }

    public function validation(){
        if(isset($_POST['verification'])){
            $email = $_POST['email'];
            $cle = $_POST['verif'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $requete = "SELECT * FROM professionnels WHERE email='$email'";
            $result = $db->query($requete)->fetchColumn(12);


            if($cle != $result){
                echo "Impossible d'activer le compte";
            } else {
                $sql = "UPDATE professionnels SET valid=1 WHERE email='$email'";
                $stm = $db->prepare($sql)->execute();

                echo "Votre compte a été validé";
            }
        }
    }

    public static function login(){
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $pwd = $_POST['password'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $sql = "SELECT * FROM professionnels WHERE email = '$email'";
            $hash = $db->query($sql)->fetchColumn(3);

            if(password_verify($pwd,$hash)){
                $log = $db->query("SELECT * FROM professionnels WHERE email='$email' AND pwd='$hash'")->fetchAll(PDO::FETCH_ASSOC);
            } else{
                echo 'Erreur';
                exit;
            }

            foreach($log as $value){
                $valid = $value['valid'];
                $name = $value['name'];
                $id = $value['id'];
                $emailLog = $value['email'];
                $phone = $value['phone'];
                $address = $value['address'];
                $agreement = $value['num_agreement'];
                $siret = $value['num_siret'];
                $active = $value['active'];
                $price = $value['price'];
                $picture = $value['picture'];
            }

            if ($valid==1){
                echo "Connexion réussi";
                session_start();
                $_SESSION['login'] = 1;
                $_SESSION['loginPro'] = 1;
                $_SESSION['nom'] = $name;
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $emailLog;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                $_SESSION['agreement'] = $agreement;
                $_SESSION['siret'] = $siret;
                $_SESSION['active'] = $active;
                $_SESSION['price'] = $price;
                $_SESSION['picture'] = $picture;

                ?>
                <SCRIPT LANGUAGE="JavaScript">
                    document.location.href="<?= PUB_PATH?>/Professionnels/profil"
                </SCRIPT>

<?php


            } else {
                echo "Votre compte n'a pas été validé<br>";
                echo "<a href='".PUB_PATH."/Professionnels/validation'>Validation</a>";
            }




        }
    }

    public static function logout(){
        if($_SESSION['login']==1 || $_SESSION['loginUser']==1) {

            session_destroy();

            $_SESSION['login']=0;
            $_SESSION['loginUser']=0;




        }

    }

    public static function editProfil(){
        if(isset($_POST['update'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $siret = $_POST['siret'];
            $agreement = $_POST['agreement'];
            $id = $_SESSION['id'];

            try {
                $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
                $sql = "UPDATE professionnels SET name='$name', email='$email', address='$address',phone='$phone',num_siret='$siret',num_agreement='$agreement'WHERE id='$id'";
                $stm = $db->prepare($sql)->execute();

            } catch (PDOException $e){
                echo $e->getMessage();
            }





            echo "Votre compte a été modifié";
            ?>
            <SCRIPT LANGUAGE="JavaScript">
                document.location.href="<?=PUB_PATH?>/Professionnels/logout"
            </SCRIPT>

            <?php
        }
    }

    public static function viewAgenda(){
        $idPro = $_SESSION['id'];
        $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
        $requete = $db->prepare("SELECT * FROM availability WHERE professionnels_id='$idPro'");
        $requete->execute();

        $data = $requete->fetchAll();

        $_SESSION['date1'] = $data;


    }

    public static function addAgenda(){
        if(isset($_POST['addDispo'])){
            $date = $_POST['date'];
            $begin = $_POST['begin'];
            $end = $_POST['end'];
            $seats = $_POST['seats'];

            $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');
            $requete = $db->prepare("INSERT INTO availability(id,date,begin,end,seats,professionnels_id) VALUES(NULL,:date,:begin,:end,:seats,:professionnels_id)");
            $requete->bindParam(':date',$date);
            $requete->bindParam(':begin',$begin);
            $requete->bindParam(':end',$end);
            $requete->bindParam(':seats',$seats);
            $requete->bindParam(':professionnels_id',$_SESSION['id']);

            $requete->execute();

            echo "Agenda mis à jour";


        }
    }

    public static function viewGardes(){
        $id = $_SESSION['id'];

        $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');


        $requete5 = $db->prepare("SELECT * FROM planning INNER JOIN children_has_professionnels ON planning.id=children_has_professionnels.planning_id 
          AND children_has_professionnels.professionnels_id = '$id'");
        $requete5->execute();

        $_SESSION['data5']=$requete5->fetchAll();



        $requete6 =$db->prepare("SELECT * FROM children INNER JOIN children_has_professionnels ON children.id=children_has_professionnels.children_id
                  AND children_has_professionnels.professionnels_id='$id' LIMIT 1");
        $requete6->execute();
        $_SESSION['data6']=$requete6->fetchAll();

    }

    public function liste(){
        $db = new PDO('mysql:host=172.16.18.128;dbname=childcare','joffrey','azerty');

        $request = $db->prepare("SELECT * FROM professionnels");
        $request->execute();

        $liste = $request->fetchAll();


        return $liste;




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
    public function setId($id): void
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
    public function setName($name): void
    {
        $this->name = $name;
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
    public function setEmail($email): void
    {
        $this->email = $email;
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
    public function setPwd($pwd): void
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
    public function setValid($valid): void
    {
        $this->valid = $valid;
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
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getNumAgreement()
    {
        return $this->num_agreement;
    }

    /**
     * @param mixed $num_agreement
     */
    public function setNumAgreement($num_agreement): void
    {
        $this->num_agreement = $num_agreement;
    }

    /**
     * @return mixed
     */
    public function getNumSiret()
    {
        return $this->num_siret;
    }

    /**
     * @param mixed $num_siret
     */
    public function setNumSiret($num_siret): void
    {
        $this->num_siret = $num_siret;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
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
    public function setVerif($verif): void
    {
        $this->verif = $verif;
    }



}
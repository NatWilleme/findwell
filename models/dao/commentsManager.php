<?php

abstract class CommentsManager extends DBManager{
    
    static public function addComment(Comment $comment){
        $sql = "INSERT INTO comments (comment_com, image_com, id_comp, id_user)
                VALUES (:comment_com, :image_com, :id_comp, :id_user)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':comment_com' => $comment->__get('comment'), ':image_com' => $comment->__get('image'),
                                ':id_comp' => $comment->__get('id_comp'), ':id_user' => $comment->__get('id_user')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updateComment(Comment $comment){
        $sql = "UPDATE comments SET comment_com=:comment_com, image_com=:image_com WHERE id_com=:id_com";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_com' => $comment->__get('id'), ':comment_com' => $comment->__get('comment'), ':image_com' => $comment->__get('image')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function deleteComment(int $idComment){
        $sql = "UPDATE comments SET deleted_com=:deleted_com WHERE id_com=:id_com";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_com' => $idComment, ':deleted_com' => 1));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getCommentsForACompany($idCompany){
        $result = array();
        $sql = "SELECT * FROM comments WHERE id_comp = :id_comp AND deleted_com = 0 ORDER BY date_com";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_com"],  
                    "comment" => $elem["comment_com"],  
                    "image" => $elem["image_com"],
                    "rating" => $elem["rate_com"],
                    "date" => $elem["date_com"],  
                    "id_comp" => $elem["id_comp"], 
                    "id_user" => $elem["id_user"],
                    "deleted" => $elem["deleted_com"]
                );
                $comment = new Comment();
                $comment->hydrate($values);
                array_push($result,$comment);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getRatingForCompany($idCompany){
        $sql = "SELECT AVG(comments.rate_com) as rate FROM comments WHERE comments.id_comp = :id_comp";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

}

?>
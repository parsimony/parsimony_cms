<?php
namespace blog\model;
/**
* Description of entity comment
* @author Parsimony
* @top 514px
* @left 944px
*/
class comment extends \entity {

    protected $id_comment;













public function __construct(\field_ident $id_comment,\field_foreignkey $id_post,\field_string $author,\field_string $author_url,\field_mail $author_email,\field_string $author_IP,\field_date $dateGMT,\field_textarea $content,\field_state $status,\field_user $id_user,\field_foreignkey $id_parent,\field_state $type) {
        $this->id_comment = $id_comment;
        $this->id_post = $id_post;
        $this->author = $author;
        $this->author_url = $author_url;
        $this->author_email = $author_email;
        $this->author_IP = $author_IP;
        $this->dateGMT = $dateGMT;
        $this->content = $content;
        $this->status = $status;
        $this->id_user = $id_user;
        $this->id_parent = $id_parent;
        $this->type = $type;

}




// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

// DON'T TOUCH THE CODE ABOVE ##########################################################

}
?>
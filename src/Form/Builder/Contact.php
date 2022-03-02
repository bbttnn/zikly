<?php

namespace App\Form\Builder;

class Contact
{
    private string $email;

    private string $subject;

    private string $message;
   
    private string $firstname;
     
    private string $lastname;


   
     


    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
     /**
     * Get the value of firstname
     */ 

    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * set the value of firstname
     * 
     * @return self
     */
    public function setFirstname($firstname)
     {
        $this->firstname = $firstname;
        
        return $this;
     }


       /**
     * Get the value of lastname
     */ 

    public function getlastname()
    {
        return $this->lastname;
    }
    
    /**
     * set the value of lastname
     * 
     * @return self
     */
    public function setlastname($lastname)
     {
        $this->lastname = $lastname;
        
        return $this;
     }

   
}





<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annotation
 *
 * @ORM\Table(name="annotation", indexes={@ORM\Index(name="fk_book_idx", columns={"book_id"})})
 * @ORM\Entity
 */
class Annotation
{
    /**
     * @var int
     *
     * @ORM\Column(name="annotation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $annotationId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quote", type="text", length=65535, nullable=true)
     */
    private $quote;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="text", length=65535, nullable=true)
     */
    private $note;

    /**
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_id", referencedColumnName="book_id")
     * })
     */
    private $book;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


    /**
     * Get the value of annotationId
     *
     * @return  int
     */ 
    public function getAnnotationId()
    {
        return $this->annotationId;
    }

    /**
     * Get the value of page
     *
     * @return  int|null
     */ 
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get the value of note
     *
     * @return  string|null
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the value of book
     *
     * @return  Book
     */ 
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of quote
     *
     * @return  string|null
     */ 
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */ 
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the value of page
     *
     * @param  int|null  $page
     *
     * @return  self
     */ 
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Set the value of quote
     *
     * @param  string|null  $quote
     *
     * @return  self
     */ 
    public function setQuote($quote)
    {
        $this->quote = $quote;

        return $this;
    }

    /**
     * Set the value of note
     *
     * @param  string|null  $note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Set the value of book
     *
     * @param  Book  $book
     *
     * @return  self
     */ 
    public function setBook(Book $book)
    {
        $this->book = $book;

        return $this;
    }
}

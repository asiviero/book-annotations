<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", indexes={@ORM\Index(name="fk_book_author_idx", columns={"author"})})
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="book_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="original_title", type="string", length=255, nullable=true)
     */
    private $originalTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="edition", type="string", length=45, nullable=true)
     */
    private $edition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="year", type="string", length=45, nullable=true)
     */
    private $year;

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="author_id")
     * })
     */
    private $author;

    public function __toString()
    {
        return sprintf('%s - %s', $this->title, $this->author);
    }

    /**
     * Get the value of title
     *
     * @return  string|null
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of author
     *
     * @return  Author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get the value of bookId
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->bookId;
    }

    /**
     * Get the value of bookId
     *
     * @return  int
     */ 
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * Get the value of originalTitle
     *
     * @return  string|null
     */ 
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Set the value of originalTitle
     *
     * @param  string|null  $originalTitle
     *
     * @return  self
     */ 
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    /**
     * Set the value of title
     *
     * @param  string|null  $title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of edition
     *
     * @return  string|null
     */ 
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set the value of edition
     *
     * @param  string|null  $edition
     *
     * @return  self
     */ 
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Set the value of year
     *
     * @param  string|null  $year
     *
     * @return  self
     */ 
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of year
     *
     * @return  string|null
     */ 
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of author
     *
     * @param  Author  $author
     *
     * @return  self
     */ 
    public function setAuthor(Author $author)
    {
        $this->author = $author;

        return $this;
    }
}

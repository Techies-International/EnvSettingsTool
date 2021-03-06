<?php

class Est_Message {

    const ERROR = 0;
    const WARNING = 1;
    const OK = 2;
    const SKIPPED = 3;
    const INFO = 4;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $level;

    /**
     * Constructor
     *
     * @param string $text
     * @param int $level
     */
    public function __construct($text, $level=Est_Message::OK) {
        $this->text = $text;
        $this->level = $level;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Get level
     * see class constants
     *
     * @return int
     */
    public function getLevel() {
        return $this->level;
    }

    /**
     * Get colored text message
     *
     * @return string
     * @throws Exception
     */
    public function getColoredText() {

        $color = null;
        switch ($this->getLevel()) {
            case Est_Message::OK: $color = 'green'; break;
            case Est_Message::WARNING: $color = 'light_red'; break;
            case Est_Message::SKIPPED: $color = 'blue'; break;
            case Est_Message::ERROR: $color = 'red'; break;
            case Est_Message::INFO: $color = null; break;
            default: throw new Exception('Invalid level');
        }

        return is_null($color) ? $this->getText() : Est_CliOutput::getColoredString($this->getText(), $color);
    }

}
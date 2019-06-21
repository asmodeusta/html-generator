<?php


class html
{

    const TAGS = [
        'div',
        'table',
        'thead',
        'tbody',
        'tr',
        'th',
        'td',
        'span'
    ];

    private $content = '';

    private $components = [];


    public function __toString()
    {
        return $this->render();
    }

    public function render()
    {
        $offset = 0;
        foreach ($this->components as $position => $component) {
            $position += $offset;
            if ($component instanceof self) {
                $content = $component->__toString();
                $offset += strlen($content);
                $this->content = substr($this->content, 0, $position) . $content . substr($this->content, $position);
            }
        }
        return $this->content;
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {

    }

    /**
     * @return html
     */
    public function div()
    {
        // Rendering opening tag
        $this->content .= '<div';
        // TODO: render attributes
        $this->content .= '>';

        // TODO: render content

        // Create child element
        $component = new self();
        $this->components[strlen($this->content)] = $component;
        // Rendering closing tag
        $this->content .= '</div>';
        return $component;
    }


}
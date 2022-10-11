<?php

class HtmlDoc {
    private function beginDocument() {
        echo '<!DOCTYPE html>
        <html>';
    }    

    private function showHeadSection() {
        echo '<head>';
        $this->showHeadContent();
        echo '</head>';
    }

    private function showHeadContent() {
        echo '<title>Title</title>';
    }

    private function showBodySection() {
        echo '<body>';
        $this->showBodyContent();
        echo '</body>';
    }

    private function showBodyContent() {
        echo '<h1>Body</h1>';
    }

    private function endDocument() {
        echo '</html>';
    }
    
    public function show() {
        $this->beginDocument();
        $this->showHeadSection();
        $this->showBodySection();
        $this->endDocument();
    }
}



?>
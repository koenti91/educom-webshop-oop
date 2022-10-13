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

    protected function showHeadContent() {
        echo '<title>Title</title>';
    }

    private function showBodySection() {
        echo '<body>';
        $this->showBodyContent();
        echo '</body>';
    }

    protected function showBodyContent() {
        echo '<p>Body<p>';
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
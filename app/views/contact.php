<?php $this->layout('master', ['title' => 'Contact']) ?>

<h1>Contact</h1>

<form action="/contact" method="post">
    <input type="text" name="subject" id="subject">
    <input type="email" name="email" id="email">


    <button type="submit">Save</button>
</form>
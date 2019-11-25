</div>
<button type="button" onclick="openForm()" class="chat">
    Chat
</button>
<div class="chatPopup" id="chatForm2">
    <form action="sendMessage.php" class="formContainer" method="post" id="chatForm">
        <h3>Chat</h3>
        <!--suppress XmlInvalidId -->
        <input type="text" name="username" id="sender" placeholder="type username...">
        <input type="hidden" value="" name="user_id" id="user_id">
        <input type="hidden" value="1" name="reciever_id" id="reciever_id">
        <!--suppress XmlInvalidId -->
        <label for="message">Message</label>
        <div id="messages">

        </div>
        <textarea name="message" id="messageUser" placeholder="Type message..." required></textarea>
        <button type="submit" class="btn" value="sendMessage">Send</button>
        <button type="button" class="btnCancel" onclick="closeForm()" id="formClose">Close</button>
    </form>
</div>
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
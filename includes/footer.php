</div>

<!-- chat button to open chat form -->
<button type="button" class="chat" id="chatButtonFooter">
    Chat
</button>
<div class="chatPopup" id="chatForm2">
    <!-- chat form -->
    <form action="sendMessage.php" class="formContainer" method="post" id="chatForm">
        <h3>Chat</h3>
        <!--suppress XmlInvalidId -->
        <input type="text" name="username" id="sender" placeholder="type username...">
        <input type="hidden" value="" name="user_id" id="user_id">
        <input type="hidden" value="1" name="reciever_id" id="reciever_id">
        <!--suppress XmlInvalidId -->
        <label for="message">Message</label>
        <div id="messages">
        <!-- chat text area for receive messages from other users or admin -->
        </div>
        <!-- chat text area for communication -->
        <textarea name="message" id="messageUser" placeholder="Type message..." required></textarea>
        <button type="submit" class="btn" value="sendMessage" id="chatBtn">Send</button>
        <button type="button" class="btnCancel" id="formClose">Close</button>
    </form>
</div>

<!-- website footer 'need fixing in css' -->
<footer>
    <div class="webFoot">
        <table class="footTable">
            <td>
                <ul><a href="aboutUs.php" class="leftLinks">About Us</a></ul>
            </td>
            <td>
                <ul><a href="termsAndUse.php" class="leftLinks">Terms of Use</a></ul>
            </td>
            <td>
                <ul><a href="#" class="lightLinks">Privacy</a></ul>
            </td>
            <td>
                <ul><a href="#" class="RightLinks">Help</a></ul>
            </td>
            <td>
                <ul><a href="#" class="RightLinks">Jobs</a></ul>
            </td>
            <td>
                <ul><a href="#" class="RightLinks">Fair Trade Policy</a></ul>
            </td>
        </table>
        <p id="footText">S.T.A.L.K.E.R. &copy 2020</p>
    </div>
</footer>

<script type="text/javascript" src="dist/main.js"></script>
</body>
</html>
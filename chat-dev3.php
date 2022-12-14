<?php

use app\assets\MainPageAsset;
use yii\web\View;

/* @var $this View */

?>
<?php MainPageAsset::register($this); ?>

<?php

$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Chat dev ',
], 'description');

$this->registerMetaTag(['property' => 'og:title', 'content' => 'dev chat page']);

$this->registerCss(<<<CSS
    .allContent {
  width: 100%;
  height: 100vh;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 10% 90%;
}

.messages-panel {
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 3fr;
  grid-template-rows: 100%;
}

.contacts-block {
  height: 100%;
  width: 100%;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 6rem 6rem calc(100% - 6rem - 6rem);
  place-items: center;
}

.message-window {
  height: 100%;
  width: 100%;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 6rem calc(100% - 6rem - 6rem) 6rem;
  place-items: center;
}

.contacts-block__name-block {
  width: 100%;
  height: 100%;
}

.contacts-block_border-right {
  border-right: 1px solid #ddd;
}

.contacts-block__name-block_border-bottom {
  border-bottom: 1px solid #ddd;
}

.message-window__current-contact {
  width: 100%;
  height: 100%;
  border-bottom: 1px solid #ddd;
}

.contacts-block__name-block_vertical-align {
  display: flex;
  align-items: center;
}

.user-name {
  margin: 0;
}

.contacts-block__contacts-type_place-buttons {
  display: flex;
  gap: 1rem;
  padding: 0.5rem 0;
}

.activity__activity-status_text-styling {
  color: rgb(173, 173, 173);
  margin: 0;
}

.message-window__current-contact_align-elements {
  display: flex;
  align-items: center;
}

.current-contact__contact-info_align-elements {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
}

.current-contact__name-block_align-elements {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.message-window__new-message {
  width: 100%;
  height: 100%;
}

.message-window__new-message_wrapper {
  width: 100%;
  height: 100%;
  padding: 0.5rem;
}

.message-window__new-message_align-elements {
  display: grid;
  grid-template-columns: 5% 85% 5% 5%;
  grid-template-rows: 100%;
  place-items: center;
  padding: 0.5rem;
}

.new-message__emoji,
.new-message__add-photo {
  width: 2rem;
  height: 2rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.contacts-block__contacts-list {
  width: 100%;
  height: 100%;
  overflow-y: auto;
  padding: 0;
}

.contacts-list__contact {
  list-style-type: none;
  width: 100%;
  height: 6rem;
  border-bottom: 1px solid #ddd;
}
.contacts-list__contact:hover {
  background-color: rgb(246, 246, 246);
}
.contacts-list__contact > * {
  pointer-events: none;
}

.contact__container {
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: 20% 80%;
  grid-template-rows: 50% 50%;
}

.contact__image {
  justify-self: center;
  align-self: center;
  grid-row-start: 1;
  grid-row-end: 3;
  grid-column-start: 1;
  grid-column-end: 2;
}

.contact__name {
  justify-self: start;
  align-self: center;
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 2;
  grid-column-end: 3;
}

.contact__last-message {
  justify-self: start;
  align-self: center;
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 2;
  grid-column-end: 3;
}

.message-window__wrapper {
  width: 100%;
  height: 100%;
  overflow-y: auto;
}

.message-window__message-history {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  width: 100%;
  height: fit-content;
  padding: 0;
}

.message-history__message {
  min-height: 2rem;
  height: fit-content;
  margin: 0.5rem;
  padding: 1rem;
  width: 300px;
  height: fit-content;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.message__output {
  align-self: flex-end;
}

.message__input {
  align-self: flex-start;
  background-color: rgb(246, 246, 246);
}

CSS);

?>

<div class="allContent">
    <h1>Chat page</h1>
    <div class="messages-panel panel panel-default">
        <div class="contacts-block contacts-block_border-right">
            <div
                    class="contacts-block__name-block contacts-block__name-block_border-bottom contacts-block__name-block_vertical-align container-fluid row"
            >
                <div class="name-block__name col-sm-10">
                    <p id="userName" class="text-center user-name"></p>
                </div>
                <div class="name-block__new-chat col-sm-2">
                    <span
                            class="glyphicon glyphicon-edit"
                            aria-hidden="true"
                    ></span>
                </div>
            </div>
            <div
                    class="contacts-block__contacts-type contacts-block__contacts-type_place-buttons row"
            >
                <button class="contacts-block__primary btn btn-default col-sm-6">
                    <b>PRIMARY </b>
                </button>
                <button class="contacts-block__requests btn btn-default col-sm-6">
                    Requests <span class="badge">14</span>
                </button>
            </div>
            <ul id="contactsList" class="contacts-block__contacts-list">

            </ul>
        </div>
        <div class="message-window message-window_positioning">
            <div
                    class="message-window__current-contact message-window__current-contact_border-bottom message-window__current-contact_align-elements row"
            >
                <div
                        class="current-contact__contact-info col-sm-11 current-contact__contact-info_align-elements"
                >
                    <div class="current-contact__logo"><span
                                class="glyphicon glyphicon-user"
                                aria-hidden="true"
                        ></span></div>
                    <div
                            class="current-contact__name-block current-contact__name-block_align-elements"
                    >
                        <div id="currentContactName" class="current-contact__name"></div>
                        <div class="current-contact__activity">
                            <p id="currentContactActivity" class="small activity__activity-status_text-styling">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="current-contact__manage-block col-sm-1">
                    <div class="manage-block__info">
                      <span
                              class="glyphicon glyphicon-info-sign"
                              aria-hidden="true"
                      ></span>
                    </div>
                </div>
            </div>
            <div class="message-window__wrapper">
                <div id="messageHistory" class="message-window__message-history">
                </div>

            </div>
            <div class="message-window__new-message_wrapper">
                <div class="message-window__new-message message-window__new-message_align-elements panel panel-default">
                    <div class="new-message__emoji"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M256 352C293.2 352 319.2 334.5 334.4 318.1C343.3 308.4 358.5 307.7 368.3 316.7C378 325.7 378.6 340.9 369.6 350.6C347.7 374.5 309.7 400 256 400C202.3 400 164.3 374.5 142.4 350.6C133.4 340.9 133.1 325.7 143.7 316.7C153.5 307.7 168.7 308.4 177.6 318.1C192.8 334.5 218.8 352 256 352zM208.4 208C208.4 225.7 194 240 176.4 240C158.7 240 144.4 225.7 144.4 208C144.4 190.3 158.7 176 176.4 176C194 176 208.4 190.3 208.4 208zM304.4 208C304.4 190.3 318.7 176 336.4 176C354 176 368.4 190.3 368.4 208C368.4 225.7 354 240 336.4 240C318.7 240 304.4 225.7 304.4 208zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg></div>
                    <input type="text" class="new-message__input-field form-control"></input>
                    <div class="new-message__add-photo"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M152 120c-26.51 0-48 21.49-48 48s21.49 48 48 48s48-21.49 48-48S178.5 120 152 120zM447.1 32h-384C28.65 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM463.1 409.3l-136.8-185.9C323.8 218.8 318.1 216 312 216c-6.113 0-11.82 2.768-15.21 7.379l-106.6 144.1l-37.09-46.1c-3.441-4.279-8.934-6.809-14.77-6.809c-5.842 0-11.33 2.529-14.78 6.809l-75.52 93.81c0-.0293 0 .0293 0 0L47.99 96c0-8.822 7.178-16 16-16h384c8.822 0 16 7.178 16 16V409.3z"/></svg></div>
                    <div class="new-message__like"><span
                                class="glyphicon glyphicon-heart"
                                aria-hidden="true"
                        ></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$this->registerJs(<<<'JS'
    let chatData = {
  userName: "",
  userId: 0,
  lastLogin: null,
  userPhoto: "",
  conversations: null,
  selectedContactsType: "primary",
  selectedChat: null,

  init: function () {
    chatData.loadUserData();
  },

  loadUserData: function () {
    $.getJSON("/chat/chat-history", (data) => {
      this.userName = data.user.username;
      this.userId = data.user.id;
      this.lastLogin = new Date(data.user.last_login);
      this.userPhoto = data.user.photo;
      this.conversations = data.conversations;
    }).done(chatData.updateUserData);
  },

  updateUserData: function () {
    $("#userName").html(`<b>${chatData.userName}</b>`);
    chatData.updateConversationsList();
  },

  updateConversationsList: function () {
    for (let id in chatData.conversations) {
      $("#contactsList").append(`
            <li id=${id} class="contacts-list__contact">
                  <div class="contact__container">
                    <div class="contact__image"><span
                      class="glyphicon glyphicon-user"
                      aria-hidden="true"
                    ></span></div>
                    <div class="contact__name"><b>${
    chatData.conversations[id].username
}</b></div>
                    <div class="contact__last-message"><p class="small activity__activity-status_text-styling">
                      ${
chatData.conversations[id].messages.length
    ? chatData.conversations[id].messages[
    chatData.conversations[id].messages.length - 1
    ].message
    : ""
}
                    </p></div>
                  </div>
                </li>
            `);
    }
    $("#contactsList").click(chatData.setSelectedChat);
  },

  setSelectedChat: function (event) {
    chatData.selectedChat = event.target.id;
    chatData.showContactData();
  },

  showContactData: function () {
    $("#currentContactName").html(
      `<b>${chatData.conversations[chatData.selectedChat].username}</b>`
    );
    $("#currentContactActivity").html(
      `Active: ${chatData.conversations[chatData.selectedChat].last_login}`
    );
    chatData.showConversation();
  },

  showConversation: function () {
    // console.log(chatData.selectedChat);
    $("#messageHistory").html("");
    for (let message of chatData.conversations[chatData.selectedChat]
      .messages) {
      $("#messageHistory").append(`
        <div class="message-history__message message__${
message.sender == chatData.selectedChat ? "input" : "output"
}">${message.message}</div>
        `);
    }
    $(".message-window__wrapper").scrollTop(
      $(".message-history__message:last-child")[0].offsetTop
    );
  },
};

$(document).ready(chatData.init);
JS, View::POS_READY);

?>

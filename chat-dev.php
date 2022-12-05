<?php

use app\assets\MainPageAsset;
use yii\web\View;

/* @var $this View */

?>
<?php MainPageAsset::register($this); ?>

<?php

$this->registerJsFile('https://unpkg.com/picmo@latest/dist/umd/index.js', ['position' => $this::POS_HEAD] );

$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Chat dev ',
], 'description');

$this->registerMetaTag(['property' => 'og:title', 'content' => 'dev chat page']);

$this->registerCss(<<<CSS
.allContent {
  width: 100%;
  height: calc(100vh - 100px);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}

.messages-panel {
  border: 1px solid #ddd;
  border-radius: 10px;
  margin: 0;
  width: 100%;
  height: 100%;
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
  position: relative;
  height: 100%;
  width: 100%;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 6rem minmax(auto, calc(100% - 6rem - 6rem)) minmax(
      6rem,
      auto
    );
  place-items: center;
}

.message-window__start-new-chat {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.start-new-chat__start-button {
  border: none;
  border-radius: 10px;
  padding: 0.5rem 1rem;
  color: white;
  font-weight: bold;
  background-color: #00b446;
}

.start-new-chat__start-button:hover {
  background-color: #4dd681;
}

.current-contact__logo,
.message__sender-image,
.contact__image {
  border-radius: 50%;
  border: 1px solid #ddd;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.current-contact__logo {
  min-width: 5rem;
  min-height: 5rem;
  max-width: 5rem;
  max-height: 5rem;
}

.contacts-block__name-block {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 2rem;
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

.contacts-block__contacts-type {
  position: relative;
  border-bottom: 1px solid #ddd;
  width: 100%;
}

.contacts-block__contacts-type_place-buttons {
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 100%;
}

.contacts-type__tab {
  padding: 1rem;
  cursor: pointer;
}

.contacts-type__tab > * {
  pointer-events: none;
}

.contacts-type__underline {
  position: absolute;
  bottom: 0;
  border-bottom: 2px solid #00b446;
  transition: all 0.2s ease-in-out;
}

.activity__activity-status_text-styling {
  color: rgb(173, 173, 173);
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.last-message-date_text-styling {
  color: rgb(173, 173, 173);
  margin: 0;
}

.message-window__current-contact_align-elements {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
}

.message-window__back-to-contacts {
  display: none;
  width: 2rem;
  height: 2rem;
}

.current-contact__contact-info_align-elements {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
}

.current-contact__manage-block {
  display: flex;
  justify-content: center;
  align-items: center;
}

.current-contact__name-block_align-elements {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.message-window__new-message {
  border: 1px solid #ddd;
  border-radius: 6rem;
  width: 100%;
  height: 100%;
}

.message-window__new-message_wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  padding: 0.5rem;
}

.message-window__new-message_align-elements {
  display: grid;
  grid-template-columns: 10% 80% 10%;
  grid-template-rows: 100%;
  place-items: center;
  padding: 0.5rem;
}

.new-message__emoji,
.new-message__send-message-photo {
  border: none;
  border-radius: 50%;
  background-color: transparent;
  padding: 0;
  width: 2rem;
  height: 2rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.emoji__icon {
  width: 100%;
  height: 100%;
}

.new-message__input-field {
  width: 100%;
  border: none;
  resize: none;
}

.message-window__emoji-block-wrapper {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: transparent;
}

.message-window__emoji-block {
  position: absolute;
  width: 288px;
  height: 319px;
}

.new-message__input-field:focus-visible {
  outline: none;
}

.new-message__emoji * {
  pointer-events: none;
}

.new-message__send-photo-icon {
  width: 100%;
  height: 100%;
}

.contacts-block__contacts-list-wrapper {
  width: 100%;
  height: 100%;
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
}
.contacts-list__contact:hover {
  background-color: rgb(246, 246, 246);
}

.contacts-list__contact > * {
  pointer-events: none;
}

.contacts-list__contact_selected {
  background-color: rgb(246, 246, 246);
}

.contact__container {
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: 20% minmax(60%, auto) minmax(10%, auto);
  grid-template-rows: 50% 50%;
  column-gap: 0.5rem;
}

.contact__image {
  min-width: 4rem;
  min-height: 4rem;
  max-width: 4rem;
  max-height: 4rem;
  justify-self: center;
  align-self: center;
  grid-row-start: 1;
  grid-row-end: 3;
  grid-column-start: 1;
  grid-column-end: 2;
}

.contact__name {
  padding-right: 0.5rem;
  width: 100%;
  justify-self: start;
  align-self: center;
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 2;
  grid-column-end: 3;
}

.name_text-styling {
  font-weight: bold;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.contact__last-message-date {
  height: 100%;
  width: 100%;
  justify-self: end;
  align-self: center;
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 3;
  grid-column-end: 4;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding-right: 0.2rem;
}

.contact__last-message {
  height: 100%;
  width: 100%;
  justify-self: start;
  align-self: center;
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 2;
  grid-column-end: 4;
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

.message-history__empty-chat {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5rem;
}

.message-history__message {
  position: relative;
  padding-top: 2rem;
  min-height: 2rem;
  margin: 0.5rem;
  max-width: 300px;
  height: fit-content;
  display: flex;
  justify-content: space-around;
  align-items: flex-end;
  gap: 1rem;
}

.empty-chat__message {
  margin: 0;
  padding: 1rem;
  border-radius: 2rem;
  background-color: rgb(99, 99, 99);
  color: white;
  font-weight: bold;
}

.message__output {
  align-self: flex-end;
}

.message__input {
  align-self: flex-start;
}

.message__input > .message__text {
  background-color: rgb(246, 246, 246);
}

.message__sender-image {
  min-width: 4rem;
  min-height: 4rem;
  max-width: 4rem;
  max-height: 4rem;
}

.message__sender-image_hidden {
  display: none;
}

.message__text {
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.message__message-date {
  position: absolute;
  top: 0;
}

.message__message-date_output {
  right: 0;
}

.message__message-date_input {
  left: 0;
}

.message-date__text {
  white-space: nowrap;
  margin: 0;
  color: rgb(173, 173, 173);
  font-size: smaller;
}

.custom-badge {
  background-color: #00b446;
  border-radius: 9999px;
  color: white;
  font-weight: bolder;
  font-size: 1rem;
  padding: 0.2rem 0.4rem;
}

.custom-badge_hidden {
  display: none;
}

.new-message__sendButton {
  display: none;
  background-color: transparent;
  border: none;
  font-weight: bold;
  color: #00b446;
}

@media screen and (max-width: 1200px) {
  .messages-panel {
    grid-template-columns: 1fr 2fr;
  }
}

@media screen and (max-width: 680px) {
  .allContent {
    padding: 1rem;
  }

  .messages-panel {
    width: 365px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .message-window {
    display: none;
  }

  .message-window__current-contact_align-elements {
    display: grid;
    grid-template-columns: 10% 80% 10%;
    grid-template-rows: 100%;
  }

  .message-window__back-to-contacts {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .contacts-block_border-right {
    border-right: none;
  }
}
CSS);
?>

      <div class="allContent">
        <div class="messages-panel">
          <div class="contacts-block contacts-block_border-right">
            <div
              class="contacts-block__name-block contacts-block__name-block_border-bottom contacts-block__name-block_vertical-align"
            >
              <div class="name-block__name">
                <p id="userName" class="text-center user-name"></p>
              </div>
              <div class="name-block__new-chat">
                <span
                  class="glyphicon glyphicon-edit"
                  aria-hidden="true"
                ></span>
              </div>
            </div>
            <div
              id="contactsTypeSwitcher"
              class="contacts-block__contacts-type contacts-block__contacts-type_place-buttons"
            >
              <div class="contacts-type__underline"></div>
              <div id="primaryTab" class="contacts-type__tab">
                <b>PRIMARY</b>
              </div>
              <div id="requestsTab" class="contacts-type__tab">
                Requests
                <span
                  id="requestsNumber"
                  class="custom-badge custom-badge_hidden"
                ></span>
              </div>
            </div>
            <div class="contacts-block__contacts-list-wrapper">
              <ul id="contactsList" class="contacts-block__contacts-list"></ul>
            </div>
          </div>
          <div class="message-window message-window_positioning">
            <div class="message-window__start-new-chat">
              <button class="start-new-chat__start-button">Send message</button>
            </div>
          </div>
        </div>
      </div>
<?php

$this->registerJs(<<<'JS'
  let chatData = {
  userName: "{username}",
  userId: 0,
  lastLogin: null,
  userPhoto: "",
  conversations: null,
  lastMessages: null,
  participants: null,
  selectedContactsType: "primary",
  selectedChat: null,
  requestsNumber: 0,
  newMessageInputScrollHeight: 0,
  emojiTrigger: null,
  windowWidth: null,

  init: function () {
    chatData.windowWidth = $(window).get(0).innerWidth;
    $(window).resize(chatData.handleWindowWidth);
    chatData.loadUserData();
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);
    chatData.placeUnderline($("#primaryTab").get(0));
  },

  loadUserData: function () {
    // $.getJSON("./assets/get-list.json", (data) => {
    //   // this.userName = data.user.username;
    //   // this.userId = $("#pah_user_id").attr("value");
    //   // this.lastLogin = new Date(data.user.last_login);
    //   // this.userPhoto = data.user.photo;
    //   this.conversations = data.payload.conversations;
    //   this.lastMessages = data.payload.lastMessages;
    //   this.participants = data.payload.participants;
    // }).done(chatData.updateUserData);
    
    
    $.ajax({url: "/conversation/get-list", method: "GET"}).done((data) => {
      this.userId = $("#pah_user_id").attr("value");
      this.conversations = data.payload.conversations;
this.lastMessages = data.payload.lastMessages;
this.participants = data.payload.participants;
    }).done(chatData.updateUserData);

    $("#userName").html(`<b>${chatData.userName}</b>`);

  },

  updateUserData: function () {
    chatData.updateConversationsList();
    chatData.calculateRequestsNumber();
  },

  updateConversationsList: function () {
    $("#contactsList").html("");
    for (let id in chatData.conversations) {
      if (chatData.selectedContactsType === "primary") {
        if (chatData.conversations[id].status === 1) {
          chatData.fulfillContactsList(id);
        }
      } else if (chatData.selectedContactsType === "requests") {
        if (!chatData.conversations[id].status === 0) {
          chatData.fulfillContactsList(id);
        }
      }
    }
  },

  fulfillContactsList: function (id) {
    //add possibility for group chats

    for (let userId in chatData.participants[id]) {
      $("#contactsList").append(`
            <li id="${id}" class="contacts-list__contact">
                  <div class="contact__container">
                    <div class="contact__image"><img src="${
                      chatData.participants[id][userId].avatar_src.length
                        ? chatData.participants[id][userId].avatar_src
                        : "./assets/logo_sq.png"
                    }" class="img-responsive"></div>
                    <div class="contact__name"><p class="name name_text-styling">${
                      chatData.participants[id][userId].username
                    }</p></div>
                    <div class="contact__last-message-date"><p class="small last-message-date_text-styling">${chatData.defineDateFormat(
                      chatData.lastMessages[id].updatedAt
                    )}</p></div>
                    <div class="contact__last-message"><p class="small activity__activity-status_text-styling">
                      ${chatData.lastMessages[id].message}
                    </p></div>
                  </div>
                </li>
            `);
    }
  },

  setSelectedChat: function (event) {
    if (event.target.className.includes("contacts-list__contact")) {
      chatData.selectedChat = event.target.id;
      $(".contacts-list__contact").removeClass(
        "contacts-list__contact_selected"
      );
      $(`#${event.target.id}`).addClass("contacts-list__contact_selected");
      chatData.showMessageWindow();
      chatData.showContactData();
    }
    if (chatData.windowWidth <= 680) {
      $(".contacts-block").css({ display: "none" });
      $(".message-window").css({ display: "grid" });
    }
  },

  showContactData: function () {
    let participantsArray = Object.values(
      chatData.participants[chatData.selectedChat]
    );
    //add possibility for group chats
    $("#currentContactLogo").html(
      `<img class="img-responsive" src="${
        participantsArray[0].avatar_src.length
          ? participantsArray[0].avatar_src
          : "./assets/logo_sq.png"
      }">`
    );
    $("#currentContactName").html(`<b>${participantsArray[0].username}</b>`);
    $("#currentContactActivity").html(
      `Active: ${chatData.defineDateFormat(participantsArray[0].lastvisit_at)}`
    );
    chatData.showConversation();
  },

  showConversation: function () {
    //add possibility for group chats
    let participantsArray = Object.values(
      chatData.participants[chatData.selectedChat]
    );

    // $.getJSON("./assets/get-messages.json", (data) => {
    //   return data;
    // })
        $.ajax(`/conversation/get-messages?conversationId=${chatData.selectedChat}`, (data) => {
      return data;
    })
    .done(function (data) {
      let messages = data.payload.messages
      $("#messageHistory").html("");
      if (messages) {
        for (let messageId in messages) {
          $("#messageHistory").append(`
            <div class="message-history__message message__${
              messages[messageId].ownerId == chatData.userId
                ? "output"
                : "input"
            }"><div class="message__message-date message__message-date_${
            messages[messageId].ownerId == chatData.userId ? "output" : "input"
          }"><p class="message-date__text">${chatData.formatMessageDate(
            messages[messageId].createdAt
          )}</p></div><div class="message__sender-image ${
            messages[messageId].ownerId == chatData.userId
              ? "message__sender-image_hidden"
              : ""
          }"><img src="${
            messages[messageId].ownerId == chatData.userId
              ? ""
              : participantsArray[0].avatar_src.length
              ? participantsArray[0].avatar_src
              : "./assets/logo_sq.png"
          }" class="img-responsive"></div><div class="message__text">${
            messages[messageId].message
          }</div></div>
            `);
        }
        $(".message-window__wrapper").scrollTop(
          $(".message-history__message:last-child")[0].offsetTop
        );
      } else {
        $("#messageHistory").html(
          `<div class="message-history__empty-chat"><p class="empty-chat__message">You have no messages yet...</p></div>`
        );
      }
    });
  },

  switchContactsType: function (event) {
    if (event.target.id === "primaryTab") {
      chatData.selectedContactsType = "primary";
    } else if (event.target.id === "requestsTab") {
      chatData.selectedContactsType = "requests";
    }
    chatData.placeUnderline(event.target);
    chatData.updateConversationsList();
  },

  placeUnderline: function (target) {
    if (target.id === "primaryTab" || target.id === "requestsTab") {
      $(".contacts-type__underline").css({
        width: `${target.offsetWidth}px`,
        left: `${target.offsetLeft}px`,
      });
    }
  },

  calculateRequestsNumber: function () {
    for (let id in chatData.conversations) {
      if (!chatData.conversations[id].status === 0) {
        chatData.requestsNumber++;
      }
    }
    chatData.addRequestsBadge();
  },

  addRequestsBadge: function () {
    if ($("#requestsNumber").hasClass("custom-badge_hidden")) {
      $("#requestsNumber").removeClass("custom-badge_hidden");
    }
    if (chatData.requestsNumber > 0) {
      $("#requestsNumber").html(chatData.requestsNumber);
    } else {
      $("#requestsNumber").addClass("custom-badge_hidden");
    }
  },

  setNewMessageInputScrollHeight: function (target) {
    chatData.newMessageInputScrollHeight = target.scrollHeight;
  },

  controlInput: function (target) {
    chatData.controlNewMessageInputHeight(target);
    chatData.switchSendMessageButton(target);
  },

  controlNewMessageInputHeight: function (target) {
    if (
      target.scrollHeight < chatData.newMessageInputScrollHeight * 5 &&
      target.scrollHeight > chatData.newMessageInputScrollHeight
    ) {
      $("#newMessageInput")
        .css({
          height: chatData.newMessageInputScrollHeight,
        })
        .css({ height: target.scrollHeight });
    }
  },

  switchSendMessageButton: function (target) {
    if (
      target.value.trim().length &&
      (!$("#sendMessageButton").get(0).style.display ||
        $("#sendMessageButton").get(0).style.display === "none")
    ) {
      $("#sendPhotoIcon").fadeOut(100, function () {
        $("#sendMessageButton").fadeIn(150);
      });
    } else if (
      !target.value.trim().length &&
      $("#sendMessageButton").get(0).style.display
    ) {
      $("#sendMessageButton").fadeOut(100, function () {
        $("#sendPhotoIcon").fadeIn(150);
      });
    }
  },

  defineDateFormat: function (date) {
    if (date) {
      const today = new Date();
      const weekDays = {
        0: "Sun",
        1: "Mon",
        2: "Tue",
        3: "Wed",
        4: "Thu",
        5: "Fri",
        6: "Sat",
      };
      let messageDate = new Date(date);
      let formattedDate;

      if (
        today.getDate() === messageDate.getDate() &&
        Number(today) - Number(messageDate) < 24 * 60 * 60 * 1000
      ) {
        formattedDate = `${
          messageDate.getHours() < 10
            ? "0" + messageDate.getHours()
            : messageDate.getHours()
        }:${
          messageDate.getMinutes() < 10
            ? "0" + messageDate.getMinutes()
            : messageDate.getMinutes()
        }`;
      } else if (
        Number(today) - Number(messageDate) > 24 * 60 * 60 * 1000 &&
        Number(today) - Number(messageDate) < 24 * 60 * 60 * 1000 * 7
      ) {
        formattedDate = weekDays[messageDate.getDay()];
      } else {
        formattedDate = `${
          messageDate.getDate() < 10
            ? "0" + messageDate.getDate()
            : messageDate.getDate()
        }/${
          messageDate.getMonth() + 1 < 10
            ? "0" + (messageDate.getMonth() + 1)
            : messageDate.getMonth() + 1
        }/${String(messageDate.getFullYear()).substring(2)}`;
      }
      return formattedDate;
    } else {
      return "";
    }
  },

  formatMessageDate: function (date) {
    const messageDate = new Date(date);
    const formattedDate = `${
      messageDate.getDate() < 10
        ? "0" + messageDate.getDate()
        : messageDate.getDate()
    }/${
      messageDate.getMonth() + 1 < 10
        ? "0" + (messageDate.getMonth() + 1)
        : messageDate.getMonth() + 1
    }/${String(messageDate.getFullYear()).substring(2)} : ${
      messageDate.getHours() < 10
        ? "0" + messageDate.getHours()
        : messageDate.getHours()
    }:${
      messageDate.getMinutes() < 10
        ? "0" + messageDate.getMinutes()
        : messageDate.getMinutes()
    }`;

    return formattedDate;
  },

  createEmojiPicker: function (element) {
    chatData.emojiTrigger = element;
    const emojiPicker = picmo.createPicker({
      emojiSize: "2.5rem",
      rootElement: chatData.emojiTrigger,
      showPreview: false,
    });

    emojiPicker.addEventListener("emoji:select", (selection) => {
      chatData.addSelectedEmoji(selection);
    });
  },

  addSelectedEmoji: function (selection) {
    $("#newMessageInput").val(function (index, value) {
      return value + selection.emoji;
    });
    chatData.controlInput($("#newMessageInput").get(0));
  },

  showEmojiBlock: function () {
    const emojiButtonPosition = $(".new-message__emoji").offset();

    $(".message-window__emoji-block-wrapper")
      .html(
        `<div class="message-window__emoji-block" style="top: ${
          emojiButtonPosition.top - 319
        }px; left: ${emojiButtonPosition.left}px">
    </div>`
      )
      .fadeIn(200, function () {
        chatData.createEmojiPicker($(".message-window__emoji-block").get(0));
      });
  },

  hideEmojiBlock: function () {
    $(".message-window__emoji-block-wrapper").fadeOut();
  },

  sendMessage: function () {
    const dateNow = new Date();
    chatData.conversations[chatData.selectedChat].messages.push({
      date: dateNow,
      message: $("#newMessageInput").val(),
      sender: chatData.userId,
    });
    chatData.showConversation(chatData.selectedChat);
    $("#newMessageInput").val("");
    chatData.controlInput($("#newMessageInput").get(0));
  },

  addPicture: function () {
    $("#addPicture").click();
  },

  sendPicture: function () {
    console.log($("#addPicture").get(0).files[0]);
  },

  handleWindowWidth: function (e) {
    chatData.windowWidth = e.target.innerWidth;
  },

  backToContacts: function () {
    $(".contacts-block").css({ display: "grid" });
    $(".message-window").css({ display: "none" });
  },

  showMessageWindow: function () {
    $(".message-window").html(`
    <div
    class="message-window__current-contact message-window__current-contact_border-bottom message-window__current-contact_align-elements"
  >
    <div id="backToContacts" class="message-window__back-to-contacts">
      <span
        class="glyphicon glyphicon-menu-left"
        aria-hidden="true"
      ></span>
    </div>
    <div
      class="current-contact__contact-info current-contact__contact-info_align-elements"
    >
      <div
        id="currentContactLogo"
        class="current-contact__logo"
      ></div>
      <div
        class="current-contact__name-block current-contact__name-block_align-elements"
      >
        <div
          id="currentContactName"
          class="current-contact__name"
        ></div>
        <div class="current-contact__activity">
          <p
            id="currentContactActivity"
            class="small activity__activity-status_text-styling"
          ></p>
        </div>
      </div>
    </div>
    <div class="current-contact__manage-block">
      <div class="manage-block__info">
        <span
          class="glyphicon glyphicon-info-sign"
          aria-hidden="true"
        ></span>
      </div>
    </div>
  </div>
  <div class="message-window__wrapper">
    <div
      id="messageHistory"
      class="message-window__message-history"
    ></div>
  </div>
  <div class="message-window__new-message_wrapper">
  <div class="message-window__emoji-block-wrapper">
  </div>
    <div
      class="message-window__new-message message-window__new-message_align-elements"
    >
      <button class="new-message__emoji">
        <svg class="emoji__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
          <path
            d="M256 352C293.2 352 319.2 334.5 334.4 318.1C343.3 308.4 358.5 307.7 368.3 316.7C378 325.7 378.6 340.9 369.6 350.6C347.7 374.5 309.7 400 256 400C202.3 400 164.3 374.5 142.4 350.6C133.4 340.9 133.1 325.7 143.7 316.7C153.5 307.7 168.7 308.4 177.6 318.1C192.8 334.5 218.8 352 256 352zM208.4 208C208.4 225.7 194 240 176.4 240C158.7 240 144.4 225.7 144.4 208C144.4 190.3 158.7 176 176.4 176C194 176 208.4 190.3 208.4 208zM304.4 208C304.4 190.3 318.7 176 336.4 176C354 176 368.4 190.3 368.4 208C368.4 225.7 354 240 336.4 240C318.7 240 304.4 225.7 304.4 208zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"
          />
        </svg>
      </button>
      <textarea
        id="newMessageInput"
        placeholder="Message..."
        class="new-message__input-field"
        rows="1"
        maxlength="1000"
      ></textarea>
      <div
        id="sendMessageOrPhoto"
        class="new-message__send-message-photo"
      >
        <button
          id="sendMessageButton"
          class="new-message__sendButton"
        >
          Send
        </button>
        <svg
          id="sendPhotoIcon"
          class="new-message__send-photo-icon"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"
        >
          <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
          <path
            d="M152 120c-26.51 0-48 21.49-48 48s21.49 48 48 48s48-21.49 48-48S178.5 120 152 120zM447.1 32h-384C28.65 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM463.1 409.3l-136.8-185.9C323.8 218.8 318.1 216 312 216c-6.113 0-11.82 2.768-15.21 7.379l-106.6 144.1l-37.09-46.1c-3.441-4.279-8.934-6.809-14.77-6.809c-5.842 0-11.33 2.529-14.78 6.809l-75.52 93.81c0-.0293 0 .0293 0 0L47.99 96c0-8.822 7.178-16 16-16h384c8.822 0 16 7.178 16 16V409.3z"
          />
        </svg>
        <input
          type="file"
          id="addPicture"
          accept="image/*"
          style="display:none" />
      </div>
    </div>
  </div>
    `);
    $("#newMessageInput").on("input", (e) => chatData.controlInput(e.target));
    chatData.setNewMessageInputScrollHeight($("#newMessageInput").get(0));
    $(".new-message__emoji").click(chatData.showEmojiBlock);
    $(".message-window__emoji-block-wrapper").click(chatData.hideEmojiBlock);
    $("#sendMessageButton").click(chatData.sendMessage);
    $("#sendPhotoIcon").click(chatData.addPicture);
    $("#addPicture").on("input", () => chatData.sendPicture());
    $("#backToContacts").click(chatData.backToContacts);
  },
};

$(document).ready(chatData.init);
JS, View::POS_READY);

?>

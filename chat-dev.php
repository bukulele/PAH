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

.createNewMessage__wrapper {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.createNewMessage__container {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  background-color: white;
}

.name-block__new-chat * {
  pointer-events: none;
}

.messages-panel {
  border: 1px solid #ddd;
  border-radius: 4px;
  margin: 0;
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: 25% 75%;
  grid-template-rows: 100%;
}

.contacts-block {
  height: 100%;
  width: 100%;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: 6rem 3rem calc(100% - 3rem - 6rem);
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
  padding: 0 2rem;
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
}

.message-window__manage-buttons,
.message-window__waiting-for-confirmation {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.manage-buttons__button {
  border: none;
  border-radius: 4px;
  padding: 0.5rem 1rem;
  color: white;
  font-weight: bold;
}

.manage-buttons__accept-button {
  background-color: #00b446;
}

.manage-buttons__accept-button:hover {
  background-color: #4dd681;
}

.manage-buttons__delete-button {
  background-color: #b40000;
  display: flex;
  justify-content: center;
  align-items: center;
}

.manage-buttons__delete-button:hover {
  background-color: #d64d4d;
}

.current-contact__name-block_align-elements {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.message-window__new-message {
  border: 1px solid #ddd;
  border-radius: 4px;
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
  width: 2.5rem;
  height: 2.5rem;
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
  padding: 0 1rem;
}

.contact__image {
  min-width: 4rem;
  min-height: 4rem;
  max-width: 4rem;
  max-height: 4rem;
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

.message-window__scroll-down-button {
  position: absolute;
  display: none;
  top: -4rem;
  right: 3rem;
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  border: none;
}

.message-window__scroll-down-button * {
  pointer-events: none;
}

.message-window__message-history {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  width: 100%;
  height: fit-content;
  padding: 0 2rem;
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

.empty-chat__message,
.start-new-chat__select-chat {
  margin: 0;
  padding: 1rem;
  border-radius: 4px;
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
  border-radius: 4px;
}

.message__text_border {
  border: 1px solid #ddd;
}

.message__text_emoji {
  font-size: 6rem;
}

.message__text_link {
  color: #00b446;
  font-weight: bold;
  cursor: pointer;
}

.message__text_link:hover {
  text-decoration: underline;
}

.external-link-alert__wrapper {
  position: fixed;
  display: none;
  background-color: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.external-link-alert__container {
  position: relative;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 350px;
  height: fit-content;
  padding: 1rem;
  border-radius: 4px;
  background-color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 2rem;
}

.external-link-alert__container p {
  text-align: center;
}

.external-link-alert__button {
  padding: 0.5rem;
  border: none;
  border-radius: 4px;
  color: white;
  font-weight: bold;
}

.button__cancel-button {
  background-color: #00b446;
}

.button__cancel-button:hover {
  background-color: #4dd681;
}

.button__risk-button {
  background-color: #b40000;
}

.button__risk-button:hover {
  background-color: #d64d4d;
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
    grid-template-columns: 34% 66%;
  }
}

@media screen and (max-width: 680px) {
  .allContent {
    padding: 1rem;
  }

  .contact__container {
    grid-template-columns: 15% minmax(65%, auto) minmax(10%, auto);
    padding: 0 0.5rem;
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

  .message-window__current-contact {
    padding: 0 1rem;
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

  .message-window__message-history {
    padding: 0 1rem;
  }
}



CSS);
?>

<div class="allContent">
        <div class="messages-panel">
          <div class="contacts-block contacts-block_border-right">
            <div
              id="contactsTypeSwitcher"
              class="contacts-block__contacts-type contacts-block__contacts-type_place-buttons"
            >
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
              <div class="contacts-type__underline"></div>
            </div>
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
            <div class="contacts-block__contacts-list-wrapper">
              <ul id="contactsList" class="contacts-block__contacts-list"></ul>
            </div>
          </div>
          <div class="message-window message-window_positioning">
            <div class="message-window__start-new-chat">
              <p class="start-new-chat__select-chat">Please select a chat</p>
            </div>
          </div>
        </div>
        <div class="external-link-alert__wrapper">
          <div class="external-link-alert__container">
            <p>
              You are going to follow the external link, what could be risky!
            </p>
            <div class="external-link-alert__buttons-block">
              <button
                id="externalLinkCancel"
                class="external-link-alert__button button__cancel-button"
              >
                Stay safe
              </button>
              <button
                id="externalLinkUnderstand"
                class="external-link-alert__button button__risk-button"
              >
                I understand risk
              </button>
            </div>
          </div>
        </div>
      </div>
<?php

$this->registerJs(<<<'JS'
let chatData = {
  userId: 0,
  conversations: null,
  lastMessages: null,
  participants: null,
  selectedContactsType: "primary",
  selectedChat: null,
  requestsNumber: 0,
  newMessageInputScrollHeight: 0,
  emojiTrigger: null,
  windowWidth: null,
  updateTimerId: null,
  createNewMessageOk: false,
  conversationsListToUpdate: false,
  calculateRequestsNumberToUpdate: false,
  checkOpenedDialogToUpdate: false,
  messages: null,
  conversationToUpdate: false,
  lastMessageId: 0,
  lastMessageText: "",
  moreContactsPossible: false,
  contactsListPageLoaded: 1,

  init: function () {
    if (window.localStorage.pahChat_conversations) {
      chatData.conversations = JSON.parse(
        window.localStorage.pahChat_conversations
      );
    } else {
      window.localStorage.pahChat_conversations = "";
    }

    if (window.localStorage.pahChat_lastMessages) {
      chatData.lastMessages = JSON.parse(
        window.localStorage.pahChat_lastMessages
      );
    } else {
      window.localStorage.pahChat_lastMessages = "";
    }

    if (window.localStorage.pahChat_participants) {
      chatData.participants = JSON.parse(
        window.localStorage.pahChat_participants
      );
    } else {
      window.localStorage.pahChat_participants = "";
    }

    if (window.localStorage.pahChat_userData) {
      chatData.userData = JSON.parse(window.localStorage.pahChat_userData);
    } else {
      window.localStorage.pahChat_userData = "";
    }

    chatData.conversationsListToUpdate = true;
    chatData.calculateRequestsNumberToUpdate = true;
    chatData.moreContactsPossible = true;

    chatData.windowWidth = $(window).get(0).innerWidth;
    $(window).resize(chatData.handleWindowWidth);
    chatData.loadUserData();
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);

    //remove later?
    $(".name-block__new-chat").click(chatData.createNewChat);
  },

  loadUserData: function () {
    // $.getJSON("./assets/get-list.json", (data) => {
    //   this.userId = $("#pah_user_id").attr("value");
    //   let conversationsLoaded = data.payload.conversations;
    //   let lastMessagesLoaded = data.payload.lastMessages;
    //   let participantsLoaded = data.payload.participants;
    //   let userDataLoaded = data.payload.userData;
    //   if (
    //     window.localStorage.pahChat_conversations !==
    //     JSON.stringify(conversationsLoaded)
    //   ) {
    //     window.localStorage.pahChat_conversations =
    //       JSON.stringify(conversationsLoaded);
    //     this.conversations = conversationsLoaded;
    //     chatData.conversationsListToUpdate = true;
    //   }

    //   if (
    //     window.localStorage.pahChat_lastMessages !==
    //     JSON.stringify(lastMessagesLoaded)
    //   ) {
    //     window.localStorage.pahChat_lastMessages =
    //       JSON.stringify(lastMessagesLoaded);
    //     this.lastMessages = lastMessagesLoaded;
    //     chatData.conversationsListToUpdate = true;
    //     chatData.conversationToUpdate = true;
    //   }

    //   if (
    //     window.localStorage.pahChat_participants !==
    //     JSON.stringify(participantsLoaded)
    //   ) {
    //     window.localStorage.pahChat_participants =
    //       JSON.stringify(participantsLoaded);
    //     this.participants = participantsLoaded;
    //     chatData.calculateRequestsNumberToUpdate = true;
    //     chatData.checkOpenedDialogToUpdate = true;
    //   }

    //   if (
    //     window.localStorage.pahChat_userData !== JSON.stringify(userDataLoaded)
    //   ) {
    //     window.localStorage.pahChat_userData = JSON.stringify(userDataLoaded);
    //     this.userData = userDataLoaded;
    //     chatData.conversationsListToUpdate = true;
    //   }
    // }).done(chatData.updateUserData);

        $.ajax({url: "/conversation/get-list?sortBy=updated&page=0", method: "GET"}).done((data) => {
    this.userId = $("#pah_user_id").attr("value");
    let conversationsLoaded = data.payload.conversations;
    let lastMessagesLoaded = data.payload.lastMessages;
    let participantsLoaded = data.payload.participants;
    let userDataLoaded = data.payload.userData;
    if (
      window.localStorage.pahChat_conversations !==
      JSON.stringify(conversationsLoaded)
    ) {
      window.localStorage.pahChat_conversations =
        JSON.stringify(conversationsLoaded);
      this.conversations = conversationsLoaded;
      chatData.conversationsListToUpdate = true;
    }

    if (
      window.localStorage.pahChat_lastMessages !==
      JSON.stringify(lastMessagesLoaded)
    ) {
      window.localStorage.pahChat_lastMessages =
        JSON.stringify(lastMessagesLoaded);
      this.lastMessages = lastMessagesLoaded;
      chatData.conversationsListToUpdate = true;
    }

    if (
      window.localStorage.pahChat_participants !==
      JSON.stringify(participantsLoaded)
    ) {
      window.localStorage.pahChat_participants =
        JSON.stringify(participantsLoaded);
      this.participants = participantsLoaded;
      chatData.calculateRequestsNumberToUpdate = true;
      chatData.checkOpenedDialogToUpdate = true;
    }

    if (
      window.localStorage.pahChat_userData !== JSON.stringify(userDataLoaded)
    ) {
      window.localStorage.pahChat_userData = JSON.stringify(userDataLoaded);
      this.userData = userDataLoaded;
      chatData.conversationsListToUpdate = true;
    }
        })
    .done(() => {
    chatData.loadMoreContacts();
    })

    // .done(chatData.updateUserData);

    if (chatData.updateTimerId) {
      clearTimeout(chatData.updateTimerId);
      this.updateTimerId = setTimeout(chatData.updateData, 15000);
    } else {
      this.updateTimerId = setTimeout(chatData.updateData, 15000);
    }
  },

  loadMoreContacts: function () {
    if (chatData.moreContactsPossible) {
      $.ajax({
        url: `/conversation/get-list?sortBy=updated&page=${chatData.contactsListPageLoaded}`,
        method: "GET",
      })
        .done((data) => {
          let conversations = data.payload.conversations;
          let lastMessages = data.payload.lastMessages;
          let participants = data.payload.participants;
          let userData = data.payload.userData;
          if (Object.keys(conversations).length > 0) {
            chatData.conversations = {
              ...chatData.conversations,
              ...conversations,
            };
            chatData.contactsListPageLoaded++;
          } else {
            chatData.moreContactsPossible = false;
            chatData.contactsListPageLoaded = 1;
          }
          if (Object.keys(lastMessages).length > 0) {
            chatData.lastMessages = {
              ...chatData.lastMessages,
              ...lastMessages,
            };
          }
          if (Object.keys(participants).length > 0) {
            chatData.participants = {
              ...chatData.participants,
              ...participants,
            };
          }
          if (Object.keys(userData).length > 0) {
            chatData.userData = { ...chatData.userData, ...userData };
          }
        })
        .done(() => {
          chatData.loadMoreContacts();
        });
    } else {
      chatData.updateUserData();
    }
  },

  updateUserData: function () {
    if (chatData.conversationsListToUpdate) {
      chatData.updateConversationsList();
    }
    if (chatData.calculateRequestsNumberToUpdate) {
      chatData.calculateRequestsNumber();
    }
    if (chatData.checkOpenedDialogToUpdate) {
      chatData.checkOpenedDialog();
    }
  },

  checkOpenedDialog: function () {
    if (
      ($(".message-window__manage-buttons").get(0) ||
        $(".message-window__waiting-for-confirmation").get(0)) &&
      chatData.conversations[chatData.selectedChat].status === 1
    ) {
      chatData.selectedContactsType = "primary";
      chatData.updateConversationsList();
      chatData.showNewMessageBlock(chatData.selectedChat);
      chatData.checkOpenedDialogToUpdate = false;
    }
  },

  updateConversationsList: function () {
    $("#contactsList").html("");
    for (let id in chatData.conversations) {
      if (chatData.selectedContactsType === "primary") {
        if (chatData.conversations[id].status === 1) {
          chatData.fulfillContactsList(id);
        }
      } else if (chatData.selectedContactsType === "requests") {
        if (chatData.conversations[id].status === 0) {
          chatData.fulfillContactsList(id);
        }
      }
    }
    chatData.conversationsListToUpdate = false;
  },

  fulfillContactsList: function (id) {
    let participantsArray = Object.keys(chatData.participants[id]).filter(
      (id) => id !== chatData.userId
    );
    //add possibility for group chats

    if (participantsArray.length === 1) {
      let userId = participantsArray[0];
      $("#contactsList").append(`
            <li id="${id}" class="contacts-list__contact ${
        id === chatData.selectedChat ? "contacts-list__contact_selected" : ""
      }">
                  <div class="contact__container">
                    <div class="contact__image"><img src="${
                      chatData.userData[userId].avatar_src.length
                        ? chatData.userData[userId].avatar_src
                        : "./assets/logo_sq.png"
                    }" class="img-responsive"></div>
                    <div class="contact__name"><p class="name name_text-styling">${
                      chatData.userData[userId].username
                    }</p></div>
                    <div class="contact__last-message-date"><p class="small last-message-date_text-styling">${chatData.defineDateFormat(
                      chatData.lastMessages[id].createdAt
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
    let participantsArray = Object.keys(
      chatData.participants[chatData.selectedChat]
    ).filter((id) => id !== chatData.userId);
    //add possibility for group chats

    if (participantsArray.length === 1) {
      let userId = participantsArray[0];
      $("#currentContactLogo").html(
        `<img class="img-responsive" src="${
          chatData.userData[userId].avatar_src.length
            ? chatData.userData[userId].avatar_src
            : "./assets/logo_sq.png"
        }">`
      );
      $("#currentContactName").html(
        `<b>${chatData.userData[userId].username}</b>`
      );
      $("#currentContactActivity").html(
        `Active: ${chatData.defineDateFormat(
          chatData.userData[userId].lastvisit_at
        )}`
      );
    }

    $(".manage-buttons__accept-button").click(chatData.activateChat);
    $(".manage-buttons__delete-button").click(chatData.deleteChat);
    chatData.loadConversation(true);
  },

  loadConversation: function (showNewConversation) {
    if (chatData.selectedChat) {
      // $.getJSON("./assets/get-messages.json", (data) => {
      //   return data;
      // })
        $.ajax(`/conversation/get-messages?conversationId=${chatData.selectedChat}`)
        .done(function (data) {
          if (showNewConversation) {
            chatData.messages = Object.values(data.payload.messages);
            chatData.showConversation();
          } else {
            let loadedMessages = Object.values(data.payload.messages);
            let i = loadedMessages.length - 1;

            while (!chatData.messages[i]) {
              i--;
            }
            chatData.messages = Object.values(data.payload.messages);
            chatData.updateConversation(i + 1);
          }
        });
    }
  },

  checkForEmojis: function (item) {
    const emojiRegEx = /^\p{Extended_Pictographic}+$/u;
    return emojiRegEx.test(item.message);
  },

  checkForLinks: function (message) {
    const linkRegEx =
      /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/gi;

    let newMessage = "";
    let messageArr = message.split(" ");

    if (message.match(linkRegEx)) {
      for (let i = 0; i < messageArr.length; i++) {
        let link = messageArr[i].match(linkRegEx);
        if (link) {
          messageArr[i] = messageArr[i].replace(
            linkRegEx,
            `<span class="message__text_link">${link}</span>`
          );
        }
      }

      newMessage = messageArr.join(" ");
      return newMessage;
    } else {
      return message;
    }
  },

  checkLink: function (e) {
    let urlString = e.target.innerText;

    if (!/^(?:f|ht)tps?\:\/\//.test(urlString)) {
      urlString = "http://" + urlString;
    }

    let externalUrl = new URL(urlString);
    if (externalUrl.hostname.toLowerCase() !== "pimpandhost.com") {
      chatData.showExternalLinkAlarm(urlString);
    } else {
      window.open(urlString, "newWindow");
    }
  },

  showExternalLinkAlarm: function (link) {
    $(".external-link-alert__wrapper").fadeIn(100, () => {
      $("#externalLinkCancel").click(chatData.hideExternalLinkAlarm);
      $("#externalLinkUnderstand").click(() => {
        window.open(link, "newWindow");
        chatData.hideExternalLinkAlarm();
      });
    });
  },

  hideExternalLinkAlarm: function () {
    $(".external-link-alert__wrapper").fadeOut(100);
  },

  showConversation: function () {
    //add possibility for group chats
    // let participantsArray = Object.values(
    //   chatData.participants[chatData.selectedChat]
    // );

    $("#messageHistory").html("");
    if (chatData.messages) {
      chatData.messages.forEach((item) => {
        $("#messageHistory").append(`
            <div class="message-history__message message__${
              item.ownerId == chatData.userId ? "output" : "input"
            }"><div class="message__message-date message__message-date_${
          item.ownerId == chatData.userId ? "output" : "input"
        }"><p class="message-date__text">${chatData.formatMessageDate(
          item.createdAt
        )}</p></div><div class="message__sender-image ${
          item.ownerId == chatData.userId ? "message__sender-image_hidden" : ""
        }"><img src="${
          item.ownerId == chatData.userId
            ? ""
            : chatData.userData[item.ownerId].avatar_src.length
            ? chatData.userData[item.ownerId].avatar_src
            : "./assets/logo_sq.png"
        }" class="img-responsive"></div><div class="message__text ${
          chatData.checkForEmojis(item)
            ? "message__text_emoji"
            : "message__text_border"
        }">${chatData.checkForLinks(item.message)}</div></div>
            `);
      });
      if ($(".message__text_link").get().length) {
        $(".message__text_link").click(chatData.checkLink);
      }
      chatData.messageHistoryScrollDown();
    } else {
      $("#messageHistory").html(
        `<div class="message-history__empty-chat"><p class="empty-chat__message">You have no messages yet...</p></div>`
      );
    }
  },

  updateConversation: function (i) {
    //add scroll down button
    while (i < chatData.messages.length) {
      $("#messageHistory").append(`
      <div class="message-history__message message__${
        chatData.messages[i].ownerId == chatData.userId ? "output" : "input"
      }"><div class="message__message-date message__message-date_${
        chatData.messages[i].ownerId == chatData.userId ? "output" : "input"
      }"><p class="message-date__text">${chatData.formatMessageDate(
        chatData.messages[i].createdAt
      )}</p></div><div class="message__sender-image ${
        chatData.messages[i].ownerId == chatData.userId
          ? "message__sender-image_hidden"
          : ""
      }"><img src="${
        chatData.messages[i].ownerId == chatData.userId
          ? ""
          : chatData.userData[chatData.messages[i].ownerId].avatar_src.length
          ? chatData.userData[chatData.messages[i].ownerId].avatar_src
          : "./assets/logo_sq.png"
      }" class="img-responsive"></div><div class="message__text">${
        chatData.messages[i].message
      }</div></div>
      `);
      i++;
    }
  },

  checkMessageHistoryScrollPosition: function () {
    let fullHeight = $("#messageHistory").height();
    let scrollPosition = $(".message-window__wrapper").scrollTop();
    let visibleHeight = $(".message-window__wrapper").height();

    if ((visibleHeight + scrollPosition) / fullHeight <= 0.9) {
      $(".message-window__scroll-down-button").fadeIn();
    } else {
      $(".message-window__scroll-down-button").fadeOut();
    }
  },

  messageHistoryScrollDown: function () {
    $(".message-window__wrapper").scrollTop(
      $(".message-history__message:last-child")[0].offsetTop
    );
  },

  switchContactsType: function (event) {
    if (event.target.id === "primaryTab") {
      chatData.selectedContactsType = "primary";
    } else if (event.target.id === "requestsTab") {
      chatData.selectedContactsType = "requests";
    }
    $("#contactsList").html("");
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
      if (chatData.conversations[id].status === 0) {
        chatData.requestsNumber++;
      }
    }
    chatData.addRequestsBadge();
    chatData.calculateRequestsNumberToUpdate = false;
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
    chatData.placeUnderline($("#primaryTab").get(0));
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
      $("#sendMessageButton").fadeIn(150);
    } else if (
      !target.value.trim().length &&
      $("#sendMessageButton").get(0).style.display
    ) {
      $("#sendMessageButton").fadeOut(100);
    }

    // THIS IS THE VERSION OF SWITCHING BETWEEN PHOTO OR MESSAGE SEND BUTTONS
    // if (
    //   target.value.trim().length &&
    //   (!$("#sendMessageButton").get(0).style.display ||
    //     $("#sendMessageButton").get(0).style.display === "none")
    // ) {
    //   $("#sendPhotoIcon").fadeOut(100, function () {
    //     $("#sendMessageButton").fadeIn(150);
    //   });
    // } else if (
    //   !target.value.trim().length &&
    //   $("#sendMessageButton").get(0).style.display
    // ) {
    //   $("#sendMessageButton").fadeOut(100, function () {
    //     $("#sendPhotoIcon").fadeIn(150);
    //   });
    // }
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

  hideEmojiBlock: function (e) {
    if (e.target.id === "emojiBlockWrapper") {
      $(".message-window__emoji-block-wrapper").fadeOut();
    }
  },

  sendMessage: function () {
    // const dateNow = new Date();
    // chatData.conversations[chatData.selectedChat].messages.push({
    //   date: dateNow,
    //   message: $("#newMessageInput").val(),
    //   sender: chatData.userId,
    // });
    $.ajax({
      type: "POST",
      url: "/conversation/new-message",
      data: {
        message: $("#newMessageInput").val(),
        conversationId: chatData.selectedChat,
      },
      dataType: "json",
    })
      .done(() => {
        chatData.loadConversation(true);
        $("#newMessageInput").val("");
        chatData.controlInput($("#newMessageInput").get(0));
      })
      .fail((error) => alert(error));
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

  activateChat: function () {
    $.ajax({
      type: "POST",
      url: "/conversation/activate",
      data: {
        conversationId: chatData.selectedChat,
      },
      dataType: "json",
    })
      .done(() => {
        chatData.refreshData();
      })
      .fail((error) => alert(error));
  },

  deleteChat: function () {
    $.ajax({
      type: "POST",
      url: "/conversation/delete",
      data: {
        conversationId: chatData.selectedChat,
      },
      dataType: "json",
    })
      .done(() => {
        chatData.refreshData();
      })
      .fail((error) => alert(error));
  },

  refreshData: function () {
    chatData.selectedContactsType = "primary";
    chatData.selectedChat = null;
    chatData.requestsNumber = 0;
    chatData.placeUnderline($("#primaryTab").get(0));
    chatData.removeMessageWindow();
    chatData.loadUserData();
  },

  updateData: function () {
    chatData.requestsNumber = 0;
    chatData.loadUserData();
    chatData.loadConversation(false);
  },

  removeMessageWindow: function () {
    $(".message-window").html(`
      <div class="message-window__start-new-chat">
        <p class="start-new-chat__select-chat">Please select a chat</p>
      </div>
    `);
  },

  //where it should be?

  createNewChat: function () {
    $(".allContent").append(`
        <div class="createNewMessage__wrapper">
          <div class="createNewMessage__container">
            <input id="newMessageUidInput" type="text" placeholder="type user id" />
            <input id="newlyCreatedMessageInput" type="text" placeholder="type the message" />
            <button id="sendCreatedMessage">Send</button>
            <button id="closeCreateNewMessage">Close</button>
          </div>
        </div>
      `);

    $("#newlyCreatedMessageInput").on("input", (e) =>
      chatData.controlNewMessageInput(e.target)
    );
    $("#sendCreatedMessage").click(chatData.sendNewlyCreatedMessage);
    $("#closeCreateNewMessage").click(() =>
      $(".createNewMessage__wrapper").remove()
    );
  },

  controlNewMessageInput: function (target) {
    if (target.value.length >= 1 && $("#newMessageUidInput").val() >= 1) {
      chatData.createNewMessageOk = true;
    } else {
      chatData.createNewMessageOk = false;
    }
  },

  sendNewlyCreatedMessage: function () {
    if (chatData.createNewMessageOk) {
      $.ajax({
        type: "POST",
        url: "/conversation/new-dialog",
        data: {
          message: $("#newlyCreatedMessageInput").val(),
          companionId: $("#newMessageUidInput").val(),
        },
        dataType: "json",
      })
        .done(() => {
          $(".createNewMessage__wrapper").remove();
          chatData.refreshData();
        })
        .fail((error) => alert(error));
    } else {
      alert("incorrect input!");
    }
  },

  showNewMessageBlock: function (id) {
    // add an option for group chat
    let participantsArray = Object.keys(chatData.participants[id]).filter(
      (id) => id !== chatData.userId
    );

    if (participantsArray.length === 1) {
      if (
        chatData.conversations[chatData.selectedChat].status === 1 &&
        chatData.participants[chatData.selectedChat][chatData.userId].role === 1
      ) {
        $(".message-window__new-message_wrapper").html(`
        <button class="message-window__scroll-down-button"><span class="glyphicon glyphicon-menu-down"></span></button>
        <div id="emojiBlockWrapper" class="message-window__emoji-block-wrapper">
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
        maxlength="750"
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
          </div>
          `);

        $("#newMessageInput").on("input", (e) =>
          chatData.controlInput(e.target)
        );
        chatData.setNewMessageInputScrollHeight($("#newMessageInput").get(0));
        $(".new-message__emoji").click(chatData.showEmojiBlock);
        $(".message-window__emoji-block-wrapper").click(
          chatData.hideEmojiBlock
        );
        $("#sendMessageButton").click(chatData.sendMessage);
        $("#sendPhotoIcon").click(chatData.addPicture);
        $("#addPicture").on("input", () => chatData.sendPicture());
        $(".message-window__scroll-down-button").click(
          chatData.messageHistoryScrollDown
        );
      } else if (
        chatData.conversations[chatData.selectedChat].status === 0 &&
        chatData.participants[chatData.selectedChat][chatData.userId].role === 9
      ) {
        $(".message-window__new-message_wrapper").html(`
          <div class="message-window__manage-buttons">
          <button class="manage-buttons__button manage-buttons__accept-button">Accept</button>
          <button class="manage-buttons__button manage-buttons__delete-button">Decline</button>
          </div>
          `);
      } else if (
        chatData.conversations[chatData.selectedChat].status === 0 &&
        chatData.participants[chatData.selectedChat][chatData.userId].role === 1
      ) {
        $(".message-window__new-message_wrapper").html(`
          <div class="message-window__waiting-for-confirmation">
          <p>Please wait for the confirmation from ${
            chatData.userData[participantsArray[0]].username
          } to continue the chat</p>
          </div>
          `);
      }
    }
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
  </div>
  <div class="message-window__wrapper">
  <div
  id="messageHistory"
  class="message-window__message-history"
  >
  </div>
  </div>
  <div class="message-window__new-message_wrapper">
    </div>
  </div>
    `);

    chatData.showNewMessageBlock(chatData.selectedChat);

    $("#backToContacts").click(chatData.backToContacts);
    $(".message-window__wrapper").on(
      "scroll",
      chatData.checkMessageHistoryScrollPosition
    );
  },
};
$(document).ready(chatData.init);
JS, View::POS_READY);

?>

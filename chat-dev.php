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
@import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");

.allContent {
  width: 100%;
  height: calc(100vh - 100px - 5rem);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
  font-family: "Lato", sans-serif;
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

.moreMessages {
  position: absolute;
  top: 0;
  right: 0;
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
.message__sender-image_styling,
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

.current-contact__logo > a {
  width: 100%;
  height: 100%;
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
  white-space: nowrap;
  font-size: 80%;
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
  grid-template-rows: auto minmax(calc(100% - 6rem), 100%);
  place-items: center;
  padding: 0.5rem;
}

.message-window__message-reply-to {
  width: 100%;
  min-height: 0;
  max-height: 6rem;
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 1;
  grid-column-end: 4;
  display: none;
  grid-template-columns: 10% 80% 10%;
  grid-template-rows: 50% 50%;
}

.message-reply-to__icon {
  fill: #4dd681;
  width: 2rem;
  height: 2rem;
  grid-row-start: 1;
  grid-row-end: 3;
  grid-column-start: 1;
  grid-column-end: 2;
  place-self: center;
}

.message-reply-to__close-icon {
  fill: rgb(173, 173, 173);
  width: 1.3rem;
  height: 1.3rem;
  grid-row-start: 1;
  grid-row-end: 3;
  grid-column-start: 3;
  grid-column-end: 4;
  place-self: center;
}

.message-reply-to__close-icon * {
  pointer-events: none;
}

.message-reply-to__contact-name {
  width: 100%;
  height: 100%;
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 2;
  grid-column-end: 3;
}

.message-reply-to__message {
  width: 100%;
  height: 100%;
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 2;
  grid-column-end: 3;
}

.message-reply-to__name-text_styling {
  color: #00b446;
  font-weight: bold;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.message-reply-to_text-styling {
  color: rgb(173, 173, 173);
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.new-message__emoji {
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 1;
  grid-column-end: 2;
}

.picmo-custom,
.picmo-custom > .content > .emojiArea {
  width: fit-content !important;
}

.new-message__send-message-photo {
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 3;
  grid-column-end: 4;
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
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 2;
  grid-column-end: 3;
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
  width: fit-content;
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
  grid-template-columns: 20% minmax(50%, auto) minmax(10%, auto);
  grid-template-rows: 50% 50%;
  column-gap: 0.5rem;
  padding: 0 1rem;
}

.contact__image {
  position: relative;
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

.contact__new-message-indicator {
  display: none;
  width: 1rem;
  height: 1rem;
  background-color: #00b446;
  border-radius: 50%;
  border: 1px solid white;
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 3;
  grid-column-end: 4;
  justify-self: end;
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
  min-height: 2rem;
  margin: 2px;
  max-width: 300px;
  height: fit-content;
  display: grid;
  grid-template-rows: auto auto;
  grid-template-columns: auto auto;
  column-gap: 4px;
}

.message-history__message-wrapper {
  display: flex;
  width: 100%;
  height: fit-content;
  align-items: center;
}

.message-history__date {
  justify-content: center;
  padding: 0.5rem;
}

.message-history__reply-button * {
  pointer-events: none;
}

.message-history__reply-button {
  position: absolute;
  bottom: 0;
  width: 2rem;
  height: 2rem;
  border: 1px solid #ddd;
  border-radius: 50%;
  display: none;
  justify-content: center;
  align-items: center;
  fill: #4dd681;
}

.reply-button__output {
  left: -2.5rem;
}

.reply-button__input {
  right: -2.5rem;
}

.message-history__reply-button_sizing {
  width: 70%;
  height: 70%;
}

.message-history__message-reply-to-wrapper {
  grid-row-start: 1;
  grid-row-end: 2;
  grid-column-start: 1;
  grid-column-end: 3;
  width: fit-content;
  height: fit-content;
  margin-bottom: 4px;
  display: flex;
  justify-content: space-between;
  gap: 4px;
}

.message-history__message-reply-to-line {
  width: 2px;
  border-radius: 2px;
  background-color: rgb(145, 145, 145);
}

.message-history__message-reply-to-wrapper_input {
  flex-direction: row-reverse;
}

.message-history__message-reply-to-wrapper_output {
  flex-direction: row;
  place-self: end;
}

.message-history__message-reply-to {
  display: none;
  padding: 1rem;
  border-radius: 4px;
  border: 1px solid #ddd;
  background-color: rgb(145, 145, 145);
}

.reply-to-name__icon {
  width: 1rem;
  height: 1rem;
  fill: white;
}

.message-history__reply-to-name {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  justify-content: flex-start;
}

.message-history__reply-to-name_styling {
  color: white;
  font-weight: bold;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.message-history__reply-to-message_styling {
  color: white;
  margin: 0;
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

.date__messages-date {
  margin: 0;
  padding: 0.5rem;
  border-radius: 4px;
  background-color: rgb(145, 145, 145);
  color: white;
  font-weight: bold;
  font-size: smaller;
}

.message-history__output {
  justify-content: end;
}

.message-history__input {
  justify-content: start;
}

.message__input > .message__text_bg {
  background-color: rgb(246, 246, 246);
}

.message__output > .message__sender-image {
  display: none;
}

.message__sender-image,
.message__sender-image_hole {
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 1;
  grid-column-end: 2;
  min-width: 4rem;
  min-height: 4rem;
  max-width: 4rem;
  max-height: 4rem;
  align-self: end;
}

.message__sender-image_hidden {
  display: none;
}

.message__text {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  grid-row-start: 2;
  grid-row-end: 3;
  grid-column-start: 2;
  grid-column-end: 3;
  padding: 0.5rem 1rem;
  border-radius: 4px;
}

.message__text > p {
  margin: 0;
}

.message__text_border {
  border: 1px solid #ddd;
}

.message__text_emoji > .message__text_formatted {
  font-size: 6rem;
}

.message__text_link {
  color: #00b446;
  font-weight: bold;
  cursor: pointer;
  word-break: break-word;
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

.message-date__text {
  white-space: nowrap;
  margin: 0;
  color: rgb(173, 173, 173);
  font-size: smaller;
  width: fit-content;
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
    grid-template-columns: 15% minmax(50%, auto) minmax(10%, auto);
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

  .message__text {
    max-width: 220px;
  }

  .message-history__reply-button {
    width: 2.5rem;
    height: 2.5rem;
  }

  .reply-button__input {
    right: -3rem;
  }

  .reply-button__output {
    left: -3rem;
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
                <b>REQUESTS</b>
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
  lastSeenMessageId: 0,
  latestMessageId: 0,
  messageToReply: null,
  messagesReplies: null,
  heightToScrollAfterLoading: 0,
  messageCanBeSent: false,
  scrollAfterMessageSent: false,
  mobileDevice: false,
  today: null,

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

    chatData.today = new Date();

    //remove later?
    $(".name-block__new-chat").click(chatData.createNewChat);
    chatData.mobileDevice =
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(
        navigator.userAgent
      );
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
    //     chatData.conversationsListToUpdate = true;
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
    chatData.moreContactsPossible = true;
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
    chatData.loadConversation(false);
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
                    }" class="img-responsive">
                    </div>
                    <div class="contact__name"><p class="name name_text-styling">${
                      chatData.userData[userId].username
                    }</p></div>
                    <div class="contact__last-message-date"><p class="last-message-date_text-styling">${chatData.defineDateFormat(
                      chatData.lastMessages[id].createdAt,
                      "last message"
                    )}</p></div>
                      <div class="contact__last-message"><p class="small activity__activity-status_text-styling">
                      ${chatData.lastMessages[id].message}
                      </p></div>
                      <div id="newMessageIndicator_${id}" class="contact__new-message-indicator"></div>
                  </div>
                </li>
            `);
      chatData.checkForNewMessages(id);
    }
  },

  showNewMessageIndicator: function (id) {
    $(`#newMessageIndicator_${id}`).css({ display: "block" });
  },

  hideNewMessageIndicator: function (id) {
    $(`#newMessageIndicator_${id}`).css({ display: "none" });
  },

  setSelectedChat: function (event) {
    chatData.removeMessageToReply();
    if (chatData.windowWidth <= 680) {
      $(".contacts-block").css({ display: "none" });
      $(".message-window").css({ display: "grid" });
    }
    if (event.target.className.includes("contacts-list__contact")) {
      chatData.selectedChat = event.target.id;
      $(".contacts-list__contact").removeClass(
        "contacts-list__contact_selected"
      );
      $(`#${event.target.id}`).addClass("contacts-list__contact_selected");
      chatData.showMessageWindow();
      chatData.showContactData();
      if (sessionStorage.getItem(`PAH_messages_${chatData.selectedChat}`)) {
        chatData.messages = JSON.parse(
          sessionStorage.getItem(`PAH_messages_${chatData.selectedChat}`)
        );
        chatData.showConversation();
        chatData.loadConversation(false);
      } else {
        chatData.loadConversation(true);
      }
    }
    chatData.setNewMessageInputScrollHeight($("#newMessageInput").get(0));
  },

  showContactData: function () {
    let participantsArray = Object.keys(
      chatData.participants[chatData.selectedChat]
    ).filter((id) => id !== chatData.userId);
    //add possibility for group chats

    if (participantsArray.length === 1) {
      let userId = participantsArray[0];
      $("#currentContactLogo").html(
        `<a href="https://pimpandhost.com/album/user/${userId}" target="_blank">
          <img class="img-responsive" src="${
            chatData.userData[userId].avatar_src.length
              ? chatData.userData[userId].avatar_src
              : "./assets/logo_sq.png"
          }"></a>`
      );
      $("#currentContactName").html(
        `<b>${chatData.userData[userId].username}</b>`
      );
      $("#currentContactActivity").html(
        `Active: ${chatData.defineDateFormat(
          chatData.userData[userId].lastvisit_at,
          "active"
        )}`
      );
    }
  },

  loadConversation: function (showNewConversation) {
    if (chatData.selectedChat) {
      chatData.latestMessageId =
        Number(chatData.lastMessages[chatData.selectedChat].id) + 1;
      // $.getJSON("./assets/get-messages.json", (data) => {
      //   return data;
      // })
        $.ajax(`/conversation/get-messages?conversationId=${chatData.selectedChat}&history=true&lastSeenMessageId=${chatData.latestMessageId}`)
        .done(function (data) {
          let loadedMessages = Object.keys(data.payload.messages);
          let lastMessageId = loadedMessages[loadedMessages.length - 1];
          let chatId = data.payload.messages[lastMessageId].conversationId;
          if (
            chatData.participants[chatId][chatData.userId].lastSeenMessageId <=
            lastMessageId
          ) {
            chatData.hideNewMessageIndicator(chatId);
          }

          if (showNewConversation) {
            chatData.messages = Object.values(data.payload.messages);
            sessionStorage.setItem(
              `PAH_messages_${chatData.selectedChat}`,
              JSON.stringify(chatData.messages)
            );
            chatData.showConversation();
          } else {
            if (
              data.payload.cursorLastSeenId - 1 >
              chatData.messages[chatData.messages.length - 1].id
            ) {
              chatData.loadConversation(true);
            }

            let loadedMessages = Object.values(data.payload.messages);

            let i = loadedMessages.findIndex(
              (item) =>
                item.id === chatData.messages[chatData.messages.length - 1].id
            );

            let messagesToAppend = loadedMessages.slice(i + 1);
            chatData.messages = [...chatData.messages, ...messagesToAppend];
            sessionStorage.setItem(
              `PAH_messages_${chatData.selectedChat}`,
              JSON.stringify(chatData.messages)
            );
            chatData.updateConversation(messagesToAppend);
          }
          chatData.checkMessageHistoryScrollPosition();
          if (chatData.scrollAfterMessageSent) {
            chatData.messageHistoryScrollDown();
            chatData.scrollAfterMessageSent = false;
          }
        });
    }
  },

  loadConversationHistory: function () {
    if (chatData.selectedChat) {
      chatData.lastSeenMessageId = chatData.messages[0].id;
      $.ajax(
        `/conversation/get-messages?conversationId=${chatData.selectedChat}&history=true&lastSeenMessageId=${chatData.lastSeenMessageId}`
      ).done(function (data) {
        // chatData.lastSeenMessageId = data.payload.cursorLastSeenId;
        chatData.addHistoryToConversation(Object.values(data.payload.messages));
      });
    }
  },

  addHistoryToConversation: function (messages) {
    if (messages.length > 0) {
      for (let i = messages.length - 1; i >= 0; i--) {
        $("#messageHistory").prepend(`
        <div id="wrp_${chatData.selectedChat}_${
          messages[i].id
        }" class="message-history__message-wrapper message-history__${
          messages[i].ownerId == chatData.userId ? "output" : "input"
        }">
            <div class="message-history__message message__${
              messages[i].ownerId == chatData.userId ? "output" : "input"
            }">
            <div class="message-history__message-reply-to-wrapper message-history__message-reply-to-wrapper_${
              messages[i].ownerId == chatData.userId ? "output" : "input"
            }">
            <div id="msg_${chatData.selectedChat}_${
          messages[i].id
        }" class="message-history__message-reply-to">
                  <div class="message-history__reply-to-name">
                  <p class="small message-history__reply-to-name_styling"></p>
                  <svg class="reply-to-name__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
                  </div>
                  <div class="message-history__reply-to-message"><p class="small message-history__reply-to-message_styling"></p></div>
            </div>
            <div class="message-history__message-reply-to-line"></div>
        </div>
        <div class="message__text ${
          chatData.checkForEmojis(messages[i])
            ? "message__text_emoji"
            : "message__text_border message__text_bg"
        }">
        <div id="btn_${chatData.selectedChat}_${
          messages[i].id
        }" class="message-history__reply-button reply-button__${
          messages[i].ownerId == chatData.userId ? "output" : "input"
        }">
            <svg class="message-history__reply-button_sizing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
            </div>
        <p class="message__text_formatted">${chatData.checkForLinks(
          messages[i].message
        )}</p>
        <p class="message-date__text">${chatData.formatMessageDate(
          messages[i].createdAt
        )}</p>
        </div></div></div>
        `);
        if (chatData.mobileDevice) {
          // $(`#wrp_${chatData.selectedChat}_${messages[i].id}`).click(() => {
          //   $(".message-history__reply-button").css({ display: "none" });
          //   $(`#btn_${chatData.selectedChat}_${messages[i].id}`).css({
          //     display: "flex",
          //   });
          // });
        } else {
          $(`#wrp_${chatData.selectedChat}_${messages[i].id}`).hover(
            () => {
              $(`#btn_${chatData.selectedChat}_${messages[i].id}`).css({
                display: "flex",
              });
            },
            () => {
              $(`#btn_${chatData.selectedChat}_${messages[i].id}`).css({
                display: "none",
              });
            }
          );
        }
        if (messages[i].replyOnId) {
          $.ajax(
            `/conversation/get-message?messageId=${messages[i].replyOnId}`
          ).done((data) => {
            $(
              `#msg_${chatData.selectedChat}_${messages[i].id} > .message-history__reply-to-name > p`
            ).html(`${chatData.userData[data.payload.ownerId].username}`);
            $(
              `#msg_${chatData.selectedChat}_${messages[i].id} > .message-history__reply-to-message > p`
            ).html(`${data.payload.message}`);
            $(`#msg_${chatData.selectedChat}_${messages[i].id}`).css({
              display: "block",
            });
          });
        }
      }
      chatData.messages = [...messages, ...chatData.messages];
      chatData.controlSenderAvatar();
      chatData.controlMessageDate();
      sessionStorage.setItem(
        `PAH_messages_${chatData.selectedChat}`,
        JSON.stringify(chatData.messages)
      );
      let newHeight = $("#messageHistory").height();
      $(".message-window__wrapper").scrollTop(
        newHeight - chatData.heightToScrollAfterLoading
      );
    }
  },

  checkForEmojis: function (item) {
    const emojiRegEx =
      /^(\p{Extended_Pictographic}|\p{Emoji_Presentation}\p{Emoji_Modifier}*)+$/gu;
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
      chatData.messages.forEach((item, i) => {
        $("#messageHistory").append(`
        <div id="wrp_${chatData.selectedChat}_${
          item.id
        }" class="message-history__message-wrapper message-history__${
          item.ownerId == chatData.userId ? "output" : "input"
        }">
            <div class="message-history__message message__${
              item.ownerId == chatData.userId ? "output" : "input"
            }">
            <div class="message-history__message-reply-to-wrapper message-history__message-reply-to-wrapper_${
              item.ownerId == chatData.userId ? "output" : "input"
            }">
            <div id="msg_${chatData.selectedChat}_${
          item.id
        }" class="message-history__message-reply-to">
                  <div class="message-history__reply-to-name">
                  <p class="small message-history__reply-to-name_styling"></p>
                  <svg class="reply-to-name__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
                  </div>
                  <div class="message-history__reply-to-message"><p class="small message-history__reply-to-message_styling"></p></div>
            </div>
            <div class="message-history__message-reply-to-line"></div>
        </div>
        <div class="message__text ${
          chatData.checkForEmojis(item)
            ? "message__text_emoji"
            : "message__text_border message__text_bg"
        }">
        <div id="btn_${chatData.selectedChat}_${
          item.id
        }" class="message-history__reply-button reply-button__${
          item.ownerId == chatData.userId ? "output" : "input"
        }">
        <svg class="message-history__reply-button_sizing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
        </div>
        <p class="message__text_formatted">${chatData.checkForLinks(
          item.message
        )}</p>
        <p class="message-date__text">${chatData.formatMessageDate(
          item.createdAt
        )}</p>
        </div></div></div>
            `);
        if (chatData.mobileDevice) {
          // $(`#wrp_${chatData.selectedChat}_${item.id}`).on("click", () => {
          //   $(".message-history__reply-button").css({ display: "none" });
          // });
          // $(`#btn_${chatData.selectedChat}_${item.id}`).css({
          //   display: "flex",
          // });
        } else {
          $(`#wrp_${chatData.selectedChat}_${item.id}`).hover(
            () => {
              $(`#btn_${chatData.selectedChat}_${item.id}`).css({
                display: "flex",
              });
            },
            () => {
              $(`#btn_${chatData.selectedChat}_${item.id}`).css({
                display: "none",
              });
            }
          );
        }
        if (item.replyOnId) {
          $.ajax(`/conversation/get-message?messageId=${item.replyOnId}`).done(
            (data) => {
              $(
                `#msg_${chatData.selectedChat}_${item.id} > .message-history__reply-to-name > p`
              ).html(`${chatData.userData[data.payload.ownerId].username}`);
              $(
                `#msg_${chatData.selectedChat}_${item.id} > .message-history__reply-to-message > p`
              ).html(`${data.payload.message}`);
              $(`#msg_${chatData.selectedChat}_${item.id}`).css({
                display: "block",
              });
            }
          );
        }
      });
      chatData.controlSenderAvatar();
      chatData.messageHistoryScrollDown();
      if ($(".message__text_link").get().length) {
        $(".message__text_link").click(chatData.checkLink);
      }
      chatData.controlMessageDate();
    } else {
      $("#messageHistory").html(
        `<div class="message-history__empty-chat"><p class="empty-chat__message">You have no messages yet...</p></div>`
      );
    }
  },

  controlMessageDate: function () {
    let months = {
      0: "January",
      1: "February",
      2: "March",
      3: "April",
      4: "May",
      5: "June",
      6: "July",
      7: "August",
      8: "September",
      9: "October",
      10: "November",
      11: "December",
    };
    let firstMessageDate = new Date(chatData.messages[0].createdAt);

    if ($(".message-history__date").get(0)) {
      $(".message-history__date").remove();
    }

    if (firstMessageDate.getFullYear() !== chatData.today.getFullYear()) {
      $(`
              <div class="message-history__message-wrapper message-history__date">
                <div class="date__messages-date">
                ${months[firstMessageDate.getMonth()]} ${
        firstMessageDate.getDate() < 10
          ? "0" + firstMessageDate.getDate()
          : firstMessageDate.getDate()
      }, ${firstMessageDate.getFullYear()}
                </div>
              </div>
            `).insertBefore(
        `#wrp_${chatData.selectedChat}_${chatData.messages[0].id}`
      );
    } else if (
      firstMessageDate.getFullYear() === chatData.today.getFullYear()
    ) {
      $(`
      <div class="message-history__message-wrapper message-history__date">
        <div class="date__messages-date">
          ${months[firstMessageDate.getMonth()]} ${
        firstMessageDate.getDate() < 10
          ? "0" + firstMessageDate.getDate()
          : firstMessageDate.getDate()
      }
        </div>
      </div>
    `).insertBefore(`#wrp_${chatData.selectedChat}_${chatData.messages[0].id}`);
    }

    if (chatData.messages.length > 1) {
      for (let i = 1; i < chatData.messages.length; i++) {
        let messageDate = new Date(chatData.messages[i].createdAt);
        let messageDateText = `${messageDate.getDate()}-${messageDate.getMonth()}-${messageDate.getFullYear()}`;
        let prevMessageDate = new Date(chatData.messages[i - 1].createdAt);
        let prevMessageDateText = `${prevMessageDate.getDate()}-${prevMessageDate.getMonth()}-${prevMessageDate.getFullYear()}`;
        if (
          messageDateText !== prevMessageDateText &&
          messageDate.getFullYear() !== chatData.today.getFullYear()
        ) {
          $(`
            <div class="message-history__message-wrapper message-history__date">
              <div class="date__messages-date">
                ${months[messageDate.getMonth()]} ${
            messageDate.getDate() < 10
              ? "0" + messageDate.getDate()
              : messageDate.getDate()
          }, ${messageDate.getFullYear()}
              </div>
            </div>
          `).insertBefore(
            `#wrp_${chatData.selectedChat}_${chatData.messages[i].id}`
          );
        } else if (
          messageDateText !== prevMessageDateText &&
          messageDate.getFullYear() === chatData.today.getFullYear()
        ) {
          $(`
          <div class="message-history__message-wrapper message-history__date">
            <div class="date__messages-date">
              ${months[messageDate.getMonth()]} ${
            messageDate.getDate() < 10
              ? "0" + messageDate.getDate()
              : messageDate.getDate()
          }
            </div>
          </div>
        `).insertBefore(
            `#wrp_${chatData.selectedChat}_${chatData.messages[i].id}`
          );
        }
      }
    }
  },

  controlSenderAvatar: function () {
    for (let i = 0; i < chatData.messages.length; i++) {
      if (chatData.messages[i].ownerId == chatData.userId) {
        if (
          !$(
            `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message > .message__sender-image`
          ).get(0)
        ) {
          $(
            `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message`
          ).append(`
          <div class="message__sender-image message__sender-image_styling"><img src="${
            chatData.userData[chatData.messages[i].ownerId].avatar_src.length
              ? chatData.userData[chatData.messages[i].ownerId].avatar_src
              : "./assets/logo_sq.png"
          }" class="img-responsive"></div>
          `);
        }
      } else {
        if (
          chatData.messages[i + 1] &&
          chatData.messages[i].ownerId == chatData.messages[i + 1].ownerId
        ) {
          if (
            !$(
              `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message > .message__sender-image_hole`
            ).get(0)
          ) {
            $(
              `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message`
            ).append(`
            <div class="message__sender-image_hole"></div>
            `);
          }
        } else {
          if (
            !$(
              `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message > .message__sender-image`
            ).get(0)
          ) {
            $(
              `#wrp_${chatData.selectedChat}_${chatData.messages[i].id} > .message-history__message`
            ).append(`
            <div class="message__sender-image message__sender-image_styling"><img src="${
              chatData.userData[chatData.messages[i].ownerId].avatar_src.length
                ? chatData.userData[chatData.messages[i].ownerId].avatar_src
                : "./assets/logo_sq.png"
            }" class="img-responsive"></div>
            `);
          }
        }
      }
    }
  },

  updateConversation: function (messages) {
    if (messages.length) {
      //add scroll down button
      messages.forEach((item) => {
        $("#messageHistory").append(`
        <div id="wrp_${chatData.selectedChat}_${
          item.id
        }" class="message-history__message-wrapper message-history__${
          item.ownerId == chatData.userId ? "output" : "input"
        }">
            <div class="message-history__message message__${
              item.ownerId == chatData.userId ? "output" : "input"
            }">
            <div class="message-history__message-reply-to-wrapper message-history__message-reply-to-wrapper_${
              item.ownerId == chatData.userId ? "output" : "input"
            }">
            <div id="msg_${chatData.selectedChat}_${
          item.id
        }" class="message-history__message-reply-to">
                  <div class="message-history__reply-to-name">
                  <p class="small message-history__reply-to-name_styling"></p>
                  <svg class="reply-to-name__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
                  </div>
                  <div class="message-history__reply-to-message"><p class="small message-history__reply-to-message_styling"></p></div>
            </div>
            <div class="message-history__message-reply-to-line"></div>
        </div>
        <div class="message__text ${
          chatData.checkForEmojis(item)
            ? "message__text_emoji"
            : "message__text_border message__text_bg"
        }">
        <div id="btn_${chatData.selectedChat}_${
          item.id
        }" class="message-history__reply-button reply-button__${
          item.ownerId == chatData.userId ? "output" : "input"
        }">
        <svg class="message-history__reply-button_sizing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
        </div>
        <p class="message__text_formatted">${chatData.checkForLinks(
          item.message
        )}</p>
        <p class="message-date__text">${chatData.formatMessageDate(
          item.createdAt
        )}</p>
        </div></div></div>
            `);
        if (chatData.mobileDevice) {
          // $(`#wrp_${chatData.selectedChat}_${item.id}`).click(() => {
          //   $(".message-history__reply-button").css({ display: "none" });
          //   $(`#btn_${chatData.selectedChat}_${item.id}`).css({
          //     display: "flex",
          //   });
          // });
        } else {
          $(`#wrp_${chatData.selectedChat}_${item.id}`).hover(
            () => {
              $(`#btn_${chatData.selectedChat}_${item.id}`).css({
                display: "flex",
              });
            },
            () => {
              $(`#btn_${chatData.selectedChat}_${item.id}`).css({
                display: "none",
              });
            }
          );
        }
        if (item.replyOnId) {
          $.ajax(`/conversation/get-message?messageId=${item.replyOnId}`).done(
            (data) => {
              $(
                `#msg_${chatData.selectedChat}_${item.id} > .message-history__reply-to-name > p`
              ).html(`${chatData.userData[data.payload.ownerId].username}`);
              $(
                `#msg_${chatData.selectedChat}_${item.id} > .message-history__reply-to-message > p`
              ).html(`${data.payload.message}`);
              $(`#msg_${chatData.selectedChat}_${item.id}`).css({
                display: "block",
              });
            }
          );
        }
      });
      chatData.controlSenderAvatar();
      chatData.controlMessageDate();
    }

    if ($(".message__text_link").get().length) {
      $(".message__text_link").click(chatData.checkLink);
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

    if (scrollPosition === 0) {
      chatData.heightToScrollAfterLoading = fullHeight;
      chatData.loadConversationHistory();
    }
  },

  messageHistoryScrollDown: function () {
    $(".message-window__wrapper").scrollTop(
      $(".message-history__message-wrapper:last-child")[0].offsetTop
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
    if (
      target.value.trim().length &&
      (!$("#sendMessageButton").get(0).style.display ||
        $("#sendMessageButton").get(0).style.display === "none")
    ) {
      chatData.switchSendMessageButton(true);
      $("#sendMessageButton").fadeIn(150);
      chatData.messageCanBeSent = true;
    } else if (
      !target.value.trim().length &&
      $("#sendMessageButton").get(0).style.display
    ) {
      chatData.switchSendMessageButton(false);
      $("#sendMessageButton").fadeOut(100);
      chatData.messageCanBeSent = false;
    }
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

  switchSendMessageButton: function (showButton) {
    if (showButton) {
      $("#sendMessageButton").fadeIn(150);
      chatData.messageCanBeSent = true;
    } else {
      $("#sendMessageButton").fadeOut(100);
      chatData.messageCanBeSent = false;
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

  defineDateFormat: function (date, type) {
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
      let activeDate = new Date(date);
      let formattedDate;
      if (
        today.getDate() === activeDate.getDate() &&
        Number(today) - Number(activeDate) < 24 * 60 * 60 * 1000
      ) {
        formattedDate = `${
          activeDate.getHours() < 10
            ? "0" + activeDate.getHours()
            : activeDate.getHours()
        }:${
          activeDate.getMinutes() < 10
            ? "0" + activeDate.getMinutes()
            : activeDate.getMinutes()
        }`;
      } else if (
        today.getDate() !== activeDate.getDate() &&
        Number(today) - Number(activeDate) < 24 * 60 * 60 * 1000
      ) {
        formattedDate = formattedDate =
          type === "active" ? `yesterday` : `1 d. ago`;
      } else if (
        Number(today) - Number(activeDate) > 24 * 60 * 60 * 1000 &&
        Number(today) - Number(activeDate) < 24 * 60 * 60 * 1000 * 7
      ) {
        formattedDate = weekDays[activeDate.getDay()];
      } else {
        formattedDate =
          type === "active"
            ? `${Math.floor(
                (Number(today) - Number(activeDate)) / 24 / 60 / 60 / 1000
              )} days ago`
            : `${Math.floor(
                (Number(today) - Number(activeDate)) / 24 / 60 / 60 / 1000
              )} d. ago`;
        // formattedDate = `${
        //   activeDate.getDate() < 10
        //     ? "0" + activeDate.getDate()
        //     : activeDate.getDate()
        // }/${
        //   activeDate.getMonth() + 1 < 10
        //     ? "0" + (activeDate.getMonth() + 1)
        //     : activeDate.getMonth() + 1
        // }/${String(activeDate.getFullYear()).substring(2)}`;
      }
      return formattedDate;
    } else {
      return "";
    }
  },

  formatMessageDate: function (date) {
    const messageDate = new Date(date);
    const formattedDate = `${
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
      className: "picmo-custom",
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
    const messageInputPosition = $(".message-window__new-message").offset();

    $(".message-window__emoji-block-wrapper")
      .html(
        `<div class="message-window__emoji-block" style="top: ${
          messageInputPosition.top - 319
        }px; left: ${messageInputPosition.left}px">
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
        replyOnId: chatData.messageToReply,
      },
      dataType: "json",
    })
      .done((data) => {
        let chatId = data.payload.message.conversationId;
        let ownerId = data.payload.message.ownerId;
        let messageId = data.payload.message.id;
        chatData.participants[chatId][ownerId].lastSeenMessageId = messageId;
        chatData.scrollAfterMessageSent = true;
        chatData.removeMessageToReply();
        chatData.loadUserData();
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

  selectMessageToReply: function (e) {
    if (e.target.id.includes(`btn_${chatData.selectedChat}`)) {
      let arrayFromId = e.target.id.split("_");
      chatData.messageToReply = arrayFromId[2];
      let message = chatData.messages.find(
        (item) => item.id === chatData.messageToReply
      );
      chatData.setMessageToReply(message);
    }
  },

  setMessageToReply: function (message) {
    $(".message-window__message-reply-to").css({ display: "grid" });
    $(".message-reply-to__contact-name > p").html(
      chatData.userData[message.ownerId].username
    );
    $(".message-reply-to__message > p").html(message.message);
  },

  removeMessageToReply: function () {
    chatData.messageToReply = null;
    $(".message-reply-to__contact-name > p").html("");
    $(".message-reply-to__message > p").html("");
    $(".message-window__message-reply-to").css({ display: "none" });
  },

  textAreaKeyPressHandler: function (e) {
    if (e.keyCode == 13 && (e.shiftKey || chatData.mobileDevice)) {
      e.preventDefault();
      $("#newMessageInput").val(function (index, value) {
        return value + "\r\n";
      });
      $("#newMessageInput").scrollTop(
        $("#newMessageInput").get(0).scrollHeight
      );
      chatData.controlInput(e.target);
    } else if (e.keyCode === 13 && !e.shiftKey && chatData.messageCanBeSent) {
      e.preventDefault();
      chatData.sendMessage();
    } else if (e.keyCode === 13 && !e.shiftKey && !chatData.messageCanBeSent) {
      e.preventDefault();
    }
  },

  checkForNewMessages: function (id) {
    if (
      chatData.participants[id][chatData.userId].lastSeenMessageId <
      chatData.lastMessages[id].id
    ) {
      chatData.showNewMessageIndicator(id);
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
          <div id="messageReplyTo" class="message-window__message-reply-to">
          <div class="message-reply-to__icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg>
          </div>
          <div class="message-reply-to__contact-name"><p class="message-reply-to__name-text_styling"></p></div>
          <div class="message-reply-to__message"><p class="small message-reply-to_text-styling"></p></div>
          <div class="message-reply-to__close-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
          </div>
          </div>
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
        minlength="1"
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

        $("#newMessageInput").keypress(chatData.textAreaKeyPressHandler);
        $("#newMessageInput").on("input", (e) =>
          chatData.controlInput(e.target)
        );
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
        $(".message-reply-to__close-icon").click(chatData.removeMessageToReply);
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
        $(".manage-buttons__accept-button").click(chatData.activateChat);
        $(".manage-buttons__delete-button").click(chatData.deleteChat);
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

    $("#messageHistory").click(chatData.selectMessageToReply);
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

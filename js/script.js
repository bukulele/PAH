let chatData = {
  userName: "",
  userId: 0,
  lastLogin: null,
  userPhoto: "",
  conversations: null,
  selectedContactsType: "primary",
  selectedChat: null,
  requestsNumber: 0,
  newMessageInputScrollHeight: 0,
  emojiTrigger: null,

  init: function () {
    chatData.loadUserData();
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);
    chatData.placeUnderline($("#primaryTab").get(0));
  },

  loadUserData: function () {
    $.getJSON("./assets/chatHistory.json", (data) => {
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
    chatData.calculateRequestsNumber();
  },

  updateConversationsList: function () {
    $("#contactsList").html("");
    for (let id in chatData.conversations) {
      if (chatData.selectedContactsType === "primary") {
        if (chatData.conversations[id].following) {
          chatData.fulfillContactsList(id);
        }
      } else if (chatData.selectedContactsType === "requests") {
        if (!chatData.conversations[id].following) {
          chatData.fulfillContactsList(id);
        }
      }
    }
  },

  fulfillContactsList: function (id) {
    $("#contactsList").append(`
          <li id=${id} class="contacts-list__contact">
                <div class="contact__container">
                  <div class="contact__image"><img src="${
                    chatData.conversations[id].photo.length
                      ? chatData.conversations[id].photo
                      : "./assets/logo_sq.png"
                  }" class="img-responsive"></div>
                  <div class="contact__name"><p class="name name_text-styling">${
                    chatData.conversations[id].username
                  }</p></div>
                  <div class="contact__last-message-date"><p class="small last-message-date_text-styling">${chatData.defineDateFormat(
                    chatData.conversations[id].messages.length
                      ? chatData.conversations[id].messages[
                          chatData.conversations[id].messages.length - 1
                        ].date
                      : null
                  )}</p></div>
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
  },

  showContactData: function () {
    $("#currentContactLogo").html(
      `<img class="img-responsive" src="${
        chatData.conversations[chatData.selectedChat].photo.length
          ? chatData.conversations[chatData.selectedChat].photo
          : "./assets/logo_sq.png"
      }">`
    );
    $("#currentContactName").html(
      `<b>${chatData.conversations[chatData.selectedChat].username}</b>`
    );
    $("#currentContactActivity").html(
      `Active: ${chatData.defineDateFormat(
        chatData.conversations[chatData.selectedChat].last_login
      )}`
    );
    chatData.showConversation(chatData.selectedChat);
  },

  showConversation: function (selectedChat) {
    $("#messageHistory").html("");
    for (let message of chatData.conversations[selectedChat].messages) {
      $("#messageHistory").append(`
        <div class="message-history__message message__${
          message.sender == selectedChat ? "input" : "output"
        }"><div class="message__message-date message__message-date_${
        message.sender == selectedChat ? "input" : "output"
      }"><p class="message-date__text">${chatData.formatMessageDate(
        message.date
      )}</p></div><div class="message__sender-image ${
        message.sender == selectedChat ? "" : "message__sender-image_hidden"
      }"><img src="${
        message.sender == chatData.selectedChat
          ? chatData.conversations[selectedChat].photo.length
            ? chatData.conversations[selectedChat].photo
            : "./assets/logo_sq.png"
          : ""
      }" class="img-responsive"></div><div class="message__text">${
        message.message
      }</div></div>
        `);
    }
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
      if (!chatData.conversations[id].following) {
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
    chatData.showPictureInConsole();
  },

  showPictureInConsole: function () {
    console.log($("#addPicture").get(0).files);
  },

  showMessageWindow: function () {
    $(".message-window").html(`
    <div
    class="message-window__current-contact message-window__current-contact_border-bottom message-window__current-contact_align-elements row"
  >
    <div
      class="current-contact__contact-info col-sm-11 current-contact__contact-info_align-elements"
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
  },
};

$(document).ready(chatData.init);

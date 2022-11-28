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

  init: function () {
    chatData.loadUserData();
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);
    chatData.placeUnderline($("#primaryTab").get(0));
    chatData.setNewMessageInputScrollHeight($("#newMessageInput").get(0));
    chatData.switchSendMessageButton($("#newMessageInput").get(0));
    $("#newMessageInput").on("input", chatData.controlInput);
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
  },

  setSelectedChat: function (event) {
    chatData.selectedChat = event.target.id;
    chatData.showContactData();
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
      `Active: ${chatData.conversations[chatData.selectedChat].last_login}`
    );
    chatData.showConversation();
  },

  showConversation: function () {
    $("#messageHistory").html("");
    for (let message of chatData.conversations[chatData.selectedChat]
      .messages) {
      $("#messageHistory").append(`
        <div class="message-history__message message__${
          message.sender == chatData.selectedChat ? "input" : "output"
        }"><div class="message__sender-image ${
        message.sender == chatData.selectedChat
          ? ""
          : "message__sender-image_hidden"
      }"><img src="${
        message.sender == chatData.selectedChat
          ? chatData.conversations[chatData.selectedChat].photo.length
            ? chatData.conversations[chatData.selectedChat].photo
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

  controlInput: function (e) {
    chatData.controlNewMessageInputHeight(e.target);
    chatData.switchSendMessageButton(e.target);
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
    if (target.value.trim().length) {
      $("#sendMessageOrPhoto").html(
        "<button id='sendButton' class='new-message__sendButton'>Send</button>"
      );
    } else {
      $("#sendMessageOrPhoto")
        .html(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
      <path
        d="M152 120c-26.51 0-48 21.49-48 48s21.49 48 48 48s48-21.49 48-48S178.5 120 152 120zM447.1 32h-384C28.65 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM463.1 409.3l-136.8-185.9C323.8 218.8 318.1 216 312 216c-6.113 0-11.82 2.768-15.21 7.379l-106.6 144.1l-37.09-46.1c-3.441-4.279-8.934-6.809-14.77-6.809c-5.842 0-11.33 2.529-14.78 6.809l-75.52 93.81c0-.0293 0 .0293 0 0L47.99 96c0-8.822 7.178-16 16-16h384c8.822 0 16 7.178 16 16V409.3z"
      />
    </svg>`);
    }
  },
};

$(document).ready(chatData.init);

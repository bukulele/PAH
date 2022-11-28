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
    if (event.target.className.includes("contacts-list__contact")) {
      chatData.selectedChat = event.target.id;
      $(".contacts-list__contact").removeClass(
        "contacts-list__contact_selected"
      );
      $(`#${event.target.id}`).addClass("contacts-list__contact_selected");
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
    if (
      target.value.trim().length &&
      (!$("#sendMessageButton").get(0).style.display ||
        $("#sendMessageButton").get(0).style.display === "none")
    ) {
      $("#sendPhotoIcon").fadeOut(100, function () {
        $("#sendMessageButton").fadeIn(100);
      });
    } else if (
      !target.value.trim().length &&
      $("#sendMessageButton").get(0).style.display
    ) {
      $("#sendMessageButton").fadeOut(100, function () {
        $("#sendPhotoIcon").fadeIn(100);
      });
    }
  },
};

$(document).ready(chatData.init);

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
  },

  updateConversationsList: function () {
    for (let id in chatData.conversations) {
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
    }
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);
    chatData.placeUnderline($("#primaryTab").get(0));
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
  },

  placeUnderline: function (target) {
    if (target.id === "primaryTab" || target.id === "requestsTab") {
      $(".contacts-type__underline").css({
        width: `${target.offsetWidth}px`,
        left: `${target.offsetLeft}px`,
      });
    }
  },
};

$(document).ready(chatData.init);

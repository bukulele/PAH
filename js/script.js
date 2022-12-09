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

    chatData.windowWidth = $(window).get(0).innerWidth;
    $(window).resize(chatData.handleWindowWidth);
    chatData.loadUserData();
    $("#contactsList").click(chatData.setSelectedChat);
    $("#contactsTypeSwitcher").click(chatData.switchContactsType);

    //remove later?
    $(".name-block__new-chat").click(chatData.createNewChat);
  },

  loadUserData: function () {
    $.getJSON("./assets/get-list.json", (data) => {
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
        chatData.conversationToUpdate = true;
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
    }).done(chatData.updateUserData);

    //     $.ajax({url: "/conversation/get-list", method: "GET"}).done((data) => {
    // this.userId = $("#pah_user_id").attr("value");
    // let conversationsLoaded = data.payload.conversations;
    // let lastMessagesLoaded = data.payload.lastMessages;
    // let participantsLoaded = data.payload.participants;
    // let userDataLoaded = data.payload.userData;
    // if (
    //   window.localStorage.pahChat_conversations !==
    //   JSON.stringify(conversationsLoaded)
    // ) {
    //   window.localStorage.pahChat_conversations =
    //     JSON.stringify(conversationsLoaded);
    //   this.conversations = conversationsLoaded;
    //   chatData.conversationsListToUpdate = true;
    // }

    // if (
    //   window.localStorage.pahChat_lastMessages !==
    //   JSON.stringify(lastMessagesLoaded)
    // ) {
    //   window.localStorage.pahChat_lastMessages =
    //     JSON.stringify(lastMessagesLoaded);
    //   this.lastMessages = lastMessagesLoaded;
    //   chatData.conversationsListToUpdate = true;
    // }

    // if (
    //   window.localStorage.pahChat_participants !==
    //   JSON.stringify(participantsLoaded)
    // ) {
    //   window.localStorage.pahChat_participants =
    //     JSON.stringify(participantsLoaded);
    //   this.participants = participantsLoaded;
    //   chatData.calculateRequestsNumberToUpdate = true;
    //   chatData.checkOpenedDialogToUpdate = true;
    // }

    // if (
    //   window.localStorage.pahChat_userData !== JSON.stringify(userDataLoaded)
    // ) {
    //   window.localStorage.pahChat_userData = JSON.stringify(userDataLoaded);
    //   this.userData = userDataLoaded;
    //   chatData.conversationsListToUpdate = true;
    // }
    //     }).done(chatData.updateUserData);

    if (chatData.updateTimerId) {
      clearTimeout(chatData.updateTimerId);
      this.updateTimerId = setTimeout(chatData.updateData, 15000);
    } else {
      this.updateTimerId = setTimeout(chatData.updateData, 15000);
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
      chatData.showNewMessageBlock();
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
    $.getJSON("./assets/get-messages.json", (data) => {
      return data;
    })
      // $.ajax(`/conversation/get-messages?conversationId=${chatData.selectedChat}`)
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
        }" class="img-responsive"></div><div class="message__text">${
          item.message
        }</div></div>
            `);
      });
      $(".message-window__wrapper").scrollTop(
        $(".message-history__message:last-child")[0].offsetTop
      );
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
    chatData.conversations = null;
    chatData.lastMessages = null;
    chatData.participants = null;
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

  //

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

    if ($("#newMessageInput").get(0)) {
      $("#newMessageInput").on("input", (e) => chatData.controlInput(e.target));
      chatData.setNewMessageInputScrollHeight($("#newMessageInput").get(0));
      $(".new-message__emoji").click(chatData.showEmojiBlock);
      $(".message-window__emoji-block-wrapper").click(chatData.hideEmojiBlock);
      $("#sendMessageButton").click(chatData.sendMessage);
      $("#sendPhotoIcon").click(chatData.addPicture);
      $("#addPicture").on("input", () => chatData.sendPicture());
    }
    $("#backToContacts").click(chatData.backToContacts);
  },
};

$(document).ready(chatData.init);

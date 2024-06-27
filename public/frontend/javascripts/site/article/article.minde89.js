"use strict";
function _typeof(e) {
    "@babel/helpers - typeof";
    return (_typeof =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
            ? function (e) {
                  return typeof e;
              }
            : function (e) {
                  return e &&
                      "function" == typeof Symbol &&
                      e.constructor === Symbol &&
                      e !== Symbol.prototype
                      ? "symbol"
                      : typeof e;
              })(e);
}
function _classCallCheck(e, t) {
    if (!(e instanceof t))
        throw new TypeError("Cannot call a class as a function");
}
function _defineProperties(e, t) {
    for (var i = 0; i < t.length; i++) {
        var n = t[i];
        (n.enumerable = n.enumerable || !1),
            (n.configurable = !0),
            "value" in n && (n.writable = !0),
            Object.defineProperty(e, _toPropertyKey(n.key), n);
    }
}
function _createClass(e, t, i) {
    return (
        t && _defineProperties(e.prototype, t),
        i && _defineProperties(e, i),
        Object.defineProperty(e, "prototype", { writable: !1 }),
        e
    );
}
function _toPropertyKey(e) {
    var t = _toPrimitive(e, "string");
    return "symbol" === _typeof(t) ? t : String(t);
}
function _toPrimitive(e, t) {
    if ("object" !== _typeof(e) || null === e) return e;
    var i = e[Symbol.toPrimitive];
    if (void 0 !== i) {
        var n = i.call(e, t || "default");
        if ("object" !== _typeof(n)) return n;
        throw new TypeError("@@toPrimitive must return a primitive value.");
    }
    return ("string" === t ? String : Number)(e);
}
// var ScioloHelpArticle = new ((function () {
//     function e() {
//         _classCallCheck(this, e),
//             (this.__chatbox_index_lower = 99),
//             (this.__key_bindings = { enter: 13, escape: 27 }),
//             (this.__is_feedback_done = !1),
//             (this.__is_feedback_satisfied = !1),
//             (this.__feedback_session_id = null);
//     }
//     return (
//         _createClass(e, [
//             {
//                 key: "answer_feedback",
//                 value: function () {
//                     var e =
//                         !(arguments.length > 0 && void 0 !== arguments[0]) ||
//                         arguments[0];
//                     if (this.__is_feedback_done === !1)
//                         if (
//                             ((this.__is_feedback_done = !0),
//                             (this.__is_feedback_satisfied = e),
//                             (this.__feedback_session_id = null),
//                             window.$crisp &&
//                                 "function" == typeof window.$crisp.get &&
//                                 (this.__feedback_session_id =
//                                     window.$crisp.get("session:identifier")),
//                             this.__feedback_session_id)
//                         ) {
//                             CrispHelpdeskCommon.apply_attribute_cache(
//                                 "feedback_comment",
//                                 ".csh-article-rate-feedback-wrap",
//                                 "is-open",
//                                 !0
//                             );
//                             var t = CrispHelpdeskCommon.select_element_cache(
//                                 "feedback_comment_field",
//                                 ".csh-article-rate-feedback-field"
//                             );
//                             (t.value = ""),
//                                 t.focus(),
//                                 window.$crisp.push([
//                                     "config",
//                                     "container:index",
//                                     [this.__chatbox_index_lower],
//                                 ]);
//                         } else this.__show_feedback_thanks();
//                 },
//             },
//             {
//                 key: "type_feedback_comment",
//                 value: function (e) {
//                     switch (e.keyCode) {
//                         case this.__key_bindings.enter:
//                             if (e.ctrlKey === !0) {
//                                 var t =
//                                     CrispHelpdeskCommon.select_element_cache(
//                                         "feedback_comment_form",
//                                         ".csh-article-rate-feedback"
//                                     );
//                                 t && this.send_feedback_comment(t);
//                             }
//                             break;
//                         case this.__key_bindings.escape:
//                             this.cancel_feedback_comment();
//                     }
//                 },
//             },
//             {
//                 key: "send_feedback_comment",
//                 value: function (e) {
//                     var t = this,
//                         i = ""
//                             .concat(e.getAttribute("action"))
//                             .concat(this.__feedback_session_id, "/"),
//                         n = {
//                             rating:
//                                 this.__is_feedback_satisfied === !0
//                                     ? "helpful"
//                                     : "unhelpful",
//                             comment: (e.feedback_comment.value || "").trim(),
//                         };
//                     e.parentNode.setAttribute("data-had-error", "false"),
//                         e.setAttribute("data-is-locked", "true"),
//                         CrispHelpdeskCommon.submit_payload(
//                             "POST",
//                             i,
//                             n,
//                             function () {
//                                 t.__trigger_feedback_comment_closed_actions(!0);
//                             },
//                             function () {
//                                 e.setAttribute("data-is-locked", "false"),
//                                     e.parentNode.setAttribute(
//                                         "data-had-error",
//                                         "true"
//                                     );
//                             }
//                         );
//                 },
//             },
//             {
//                 key: "cancel_feedback_comment",
//                 value: function () {
//                     this.__trigger_feedback_comment_closed_actions(!1);
//                 },
//             },
//             {
//                 key: "__trigger_feedback_comment_closed_actions",
//                 value: function () {
//                     var e =
//                         arguments.length > 0 &&
//                         void 0 !== arguments[0] &&
//                         arguments[0];
//                     CrispHelpdeskCommon.apply_attribute_cache(
//                         "feedback_comment",
//                         ".csh-article-rate-feedback-wrap",
//                         "is-open",
//                         !1
//                     ),
//                         window.$crisp.push([
//                             "config",
//                             "container:index",
//                             [null],
//                         ]),
//                         e === !0
//                             ? this.__show_feedback_thanks()
//                             : (this.__is_feedback_done = !1);
//                 },
//             },
//             {
//                 key: "__show_feedback_thanks",
//                 value: function () {
//                     CrispHelpdeskCommon.apply_attribute_cache(
//                         "feedback_thanks",
//                         ".csh-article-rate-thanks",
//                         "is-satisfied",
//                         this.__is_feedback_satisfied
//                     ),
//                         CrispHelpdeskCommon.apply_attribute_cache(
//                             "feedback",
//                             ".csh-article-rate",
//                             "has-answer",
//                             this.__is_feedback_done
//                         );
//                 },
//             },
//         ]),
//         e
//     );
// })())();

var ScioloHelpArticle = new ((function () {
    function e() {
        _classCallCheck(this, e),
            (this.__chatbox_index_lower = 99),
            (this.__key_bindings = { enter: 13, escape: 27 }),
            (this.__is_feedback_done = !1),
            (this.__is_feedback_satisfied = !1),
            (this.__feedback_session_id = null);
    }
    return (
        _createClass(e, [
            {
                key: "answer_feedback",
                value: function (isLiked) {
                    if (this.__is_feedback_done === !1) {
                        this.__is_feedback_done = !0;
                        this.__is_feedback_satisfied = isLiked;
                        this.__feedback_session_id = null;
                        if (window.$crisp && "function" == typeof window.$crisp.get) {
                            this.__feedback_session_id = window.$crisp.get("session:identifier");
                        }
                        if (this.__feedback_session_id) {
                            CrispHelpdeskCommon.apply_attribute_cache(
                                "feedback_comment",
                                ".csh-article-rate-feedback-wrap",
                                "is-open",
                                !0
                            );
                            var t = CrispHelpdeskCommon.select_element_cache(
                                "feedback_comment_field",
                                ".csh-article-rate-feedback-field"
                            );
                            t.value = "";
                            t.focus();
                            window.$crisp.push([
                                "config",
                                "container:index",
                                [this.__chatbox_index_lower],
                            ]);
                        } else {
                            var code = $("#article_code_value").val();
                            if (isLiked) {
                                $.ajax({
                                    url: '/submit-feedback',
                                    method: 'POST',
                                    data: {
                                        feedback: 'yes',
                                        code: code
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        alert('Thank you for your feedback!');
                                        ScioloHelpArticle.__show_feedback_thanks();
                                    },
                                    error: function(error) {
                                        console.error('Error:', error);
                                    }
                                });
                            } else {
                                $('#feedbackModal').attr('data-is-open', 'true');
                            }
                        }
                    }
                },
            },
            {
                key: "submit_unlike_reason",
                value: function (event) {
                    event.preventDefault();
                    var reason = $('#unlike_reason').val();
                    var code = $("#article_code_value").val();

                    if (reason.trim() === '') {
                        alert('Please provide a reason for your feedback.');
                        return;
                    }
                    $.ajax({
                        url: '/submit-feedback',
                        method: 'POST',
                        data: {
                            feedback: 'no',
                            unlike_reason: reason,
                            code: code
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('Thank you for your feedback!');
                            $('#feedbackModal').attr('data-is-open', 'false');
                            ScioloHelpArticle.__show_feedback_thanks();
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                },
            },
            {
                key: "type_feedback_comment",
                value: function (e) {
                    switch (e.keyCode) {
                        case this.__key_bindings.enter:
                            if (e.ctrlKey === !0) {
                                var t =
                                    CrispHelpdeskCommon.select_element_cache(
                                        "feedback_comment_form",
                                        ".csh-article-rate-feedback"
                                    );
                                t && this.send_feedback_comment(t);
                            }
                            break;
                        case this.__key_bindings.escape:
                            this.cancel_feedback_comment();
                    }
                },
            },
            {
                key: "send_feedback_comment",
                value: function (e) {
                    var t = this,
                        i = ""
                            .concat(e.getAttribute("action"))
                            .concat(this.__feedback_session_id, "/"),
                        n = {
                            rating:
                                this.__is_feedback_satisfied === !0
                                    ? "helpful"
                                    : "unhelpful",
                            comment: (e.feedback_comment.value || "").trim(),
                        };
                    e.parentNode.setAttribute("data-had-error", "false"),
                        e.setAttribute("data-is-locked", "true"),
                        CrispHelpdeskCommon.submit_payload(
                            "POST",
                            i,
                            n,
                            function () {
                                t.__trigger_feedback_comment_closed_actions(!0);
                            },
                            function () {
                                e.setAttribute("data-is-locked", "false"),
                                    e.parentNode.setAttribute(
                                        "data-had-error",
                                        "true"
                                    );
                            }
                        );
                },
            },
            {
                key: "cancel_feedback_comment",
                value: function () {
                    this.__trigger_feedback_comment_closed_actions(!1);
                },
            },
            {
                key: "__trigger_feedback_comment_closed_actions",
                value: function () {
                    var e =
                        arguments.length > 0 &&
                        void 0 !== arguments[0] &&
                        arguments[0];
                    CrispHelpdeskCommon.apply_attribute_cache(
                        "feedback_comment",
                        ".csh-article-rate-feedback-wrap",
                        "is-open",
                        !1
                    ),
                        window.$crisp.push([
                            "config",
                            "container:index",
                            [null],
                        ]),
                        e === !0
                            ? this.__show_feedback_thanks()
                            : (this.__is_feedback_done = !1);
                },
            },
            {
                key: "__show_feedback_thanks",
                value: function () {
                    CrispHelpdeskCommon.apply_attribute_cache(
                        "feedback_thanks",
                        ".csh-article-rate-thanks",
                        "is-satisfied",
                        this.__is_feedback_satisfied
                    ),
                        CrispHelpdeskCommon.apply_attribute_cache(
                            "feedback",
                            ".csh-article-rate",
                            "has-answer",
                            this.__is_feedback_done
                        );
                },
            },
        ]),
        e
    );
})())();

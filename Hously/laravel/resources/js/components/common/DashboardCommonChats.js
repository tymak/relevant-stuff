import React, { useState, useEffect } from "react";

const DashboardCommonChats = ({ communities, chats, users }) => {
    /*zdravime Inventi HOOOOOKS */
    const [commun_id, setcommun_id] = useState(1);
    const [listOfChats, setlistOfChats] = useState(chats);
    const handleCommunityIDChange = e => {
        setcommun_id(Number(e.target.value));
    };

    return (
        <div className="page__main__dash__item i__mid">
            <div className="page__main__dash__item__head">
                <h4>Chat section</h4>
            </div>

            <div className="page__main__dash__item__body">
                <div className="fixedHeight__flexContainer">
                    <div className="chat__selector">
                        <label htmlFor="chats">
                            Select your chat
                            <select
                                onChange={handleCommunityIDChange}
                                name="chats"
                                id="chats"
                            >
                                {communities.map(community => (
                                    <>
                                        <option value={community.id}>
                                            {community.community_name}
                                        </option>
                                    </>
                                ))}
                            </select>
                        </label>
                    </div>

                    <div className="chat__container scrollable">
                        {listOfChats
                            .filter(chat => chat.community_id === commun_id)
                            .map((chat, index) => {
                                const chatUser = users.filter(
                                    user => user.id === chat.user_id
                                );
                                return (
                                    <div
                                        className={
                                            index % 2 == 0
                                                ? "chat__bubble b__left"
                                                : "chat__bubble b__right"
                                        }
                                    >
                                        {chatUser[0].first_name}{" "}
                                        {chatUser[0].last_name} <br />
                                        <em>{chat.text}</em>
                                    </div>
                                );
                            })}
                    </div>
                    <div className="chat__input">
                        <form
                            encType="multipart/form-data"
                            onSubmit={e => {
                                e.preventDefault();
                                const data = new FormData(e.target);
                                e.target[0].value = "";
                                fetch("/chat", {
                                    method: "post",
                                    body: data
                                }).then(() => {
                                    fetch("/api")
                                        .then(resp => resp.json())
                                        .then(data =>
                                            setlistOfChats(data.chats)
                                        );
                                });
                            }}
                        >
                            <input type="text" name="text" />
                            <input
                                type="hidden"
                                name="community_id"
                                value={commun_id}
                            />
                            <input type="hidden" name="image" value="" />
                            <input
                                type="hidden"
                                name="_token"
                                value={
                                    document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content
                                }
                            />
                            <button type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default DashboardCommonChats;

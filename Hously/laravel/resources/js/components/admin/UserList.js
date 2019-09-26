import React from "react";
const UserList = ({ residents, users, flats, handleSetDetail }) => {
    return (
        <>
            <h4>Databaze obyvatel</h4>
            <ol>
                {residents.map(resident => {
                    return (
                        <li>
                            <div>
                                {`Name: ` +
                                    `${
                                        users[resident.user_id - 1].first_name
                                    }` +
                                    ` ` +
                                    `${users[resident.user_id - 1].last_name}`}
                            </div>

                            <div>
                                {flats.map(flat => {
                                    if (flat.id == resident.flat_id)
                                        return (
                                            <>
                                                {"Flat number:" +
                                                    `${flat.number}`}
                                            </>
                                        );
                                })}
                            </div>
                            <div>
                                {`Contact: ` +
                                    `${users[resident.user_id - 1].email}`}
                            </div>
                            <div>
                                <a
                                    href={`/storage/contract/${
                                        resident.user_id
                                    }.pdf`}
                                    target="_blank"
                                >
                                    Nájemní Smlouva
                                </a>
                            </div>
                            <div>
                                <button
                                    onClick={() => {
                                        handleSetDetail(resident.user_id);
                                    }}
                                >
                                    Detail
                                </button>
                                <button
                                    onClick={() => {
                                        const metaList = document.querySelectorAll(
                                            "meta"
                                        );
                                        let _token = document.querySelector(
                                            'meta[name="csrf-token"]'
                                        ).content;
                                        let flat_id = resident.flat_id;
                                        let data = {
                                            _token,
                                            flat_id
                                        };
                                        fetch(
                                            `/su/delete/resident/${
                                                resident.id
                                            }`,
                                            {
                                                method: "post",

                                                body: JSON.stringify(data)
                                            }
                                        );
                                    }}
                                >
                                    Delete
                                </button>
                            </div>
                        </li>
                    );
                })}
            </ol>
        </>
    );
};
export default UserList;

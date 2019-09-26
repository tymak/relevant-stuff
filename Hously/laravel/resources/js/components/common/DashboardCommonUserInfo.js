import React from "react";

const DashboardCommonUserInfo = ({ user, profile }) => {
    if (!user) {
        return (
            <div className="page__main__dash__item i__big">
                <h3>My info</h3>
                <p>Error: no user data...</p>
            </div>
        );
    } else {
        return (
            <div
                className={
                    profile === "administrator"
                        ? "page__main__dash__item i__full"
                        : "page__main__dash__item i__big"
                }
            >
                <div className="page__main__dash__item__head">
                    <h3>My info</h3>
                </div>
                <div className="page__main__dash__item__body">
                    <p>
                        <strong>Name: </strong>
                        {user.first_name} {user.last_name}
                    </p>
                    <p>
                        <strong>Email: </strong>
                        {user.email}
                    </p>
                    <p>
                        <strong>Phone: </strong>
                        {user.phone_number}
                    </p>
                    <p>
                        <strong>Birth Date: </strong>
                        {user.birth_date}
                    </p>
                </div>
            </div>
        );
    }
};

export default DashboardCommonUserInfo;

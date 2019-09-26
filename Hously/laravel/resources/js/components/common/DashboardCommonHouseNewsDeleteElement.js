import React from "react";

const DashboardCommonHouseNewsDeleteElement = ({
    notice_id,
    delete_handler
}) => {
    return (
        <>
            <form
                className="item__nonpermanent"
                encType="multipart/form-data"
                onSubmit={e => {
                    e.preventDefault();
                    const data = new FormData(e.target);
                    const fetchURL = "/su/delete/notice/" + notice_id;
                    fetch(fetchURL, {
                        method: "post",
                        body: data
                    }).then(() => {
                        delete_handler();
                    });
                }}
            >
                <input
                    type="hidden"
                    name="_token"
                    value={
                        document.querySelector('meta[name="csrf-token"]')
                            .content
                    }
                />
                <button>
                    <img src="/img/trash-ico.svg" alt="" />
                </button>
            </form>
        </>
    );
};

export default DashboardCommonHouseNewsDeleteElement;

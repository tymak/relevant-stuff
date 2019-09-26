import React from "react";

const DashboardCommonHouseNewsAddElement = ({ noticeboard, add_handler }) => {
    return (
        <div className="notices__add">
            <form
                encType="multipart/form-data"
                onSubmit={e => {
                    e.preventDefault();
                    const data = new FormData(e.target);
                    e.target[0].value = "";
                    fetch("/notice", {
                        method: "post",
                        body: data
                    }).then(() => {
                        add_handler();
                    });
                }}
            >
                <label htmlFor="notice">
                    <textarea id="notice" name="notice" />
                </label>
                <input
                    type="hidden"
                    name="noticeboard"
                    value={noticeboard.id}
                />
                <input
                    type="hidden"
                    name="_token"
                    value={
                        document.querySelector('meta[name="csrf-token"]')
                            .content
                    }
                />
                <br />
                <label htmlFor="permanent">
                    Permanent?
                    <input type="checkbox" name="permanent" label="permanent" />
                </label>
                <br />
                <button>Add</button>
            </form>
        </div>
    );
};

export default DashboardCommonHouseNewsAddElement;

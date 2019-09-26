import React, { useState, useEffect } from "react";
import DashboardCommonHouseNewsAddElement from "./DashboardCommonHouseNewsAddElement.js";

const DashboardCommonHouseNewsAdminSection = ({ noticeboard, add_handler }) => {
    const [showAddElement, setshowAddElement] = useState(false);

    return (
        <>
            <div className="notices__list__adminHandler">
                {!showAddElement && (
                    <button
                        onClick={() => {
                            setshowAddElement(true);
                        }}
                    >
                        <img src="/img/write-ico.svg" alt="" />
                    </button>
                )}

                {showAddElement && (
                    <>
                        <DashboardCommonHouseNewsAddElement
                            noticeboard={noticeboard}
                            add_handler={add_handler}
                        />
                        <a
                            href="#"
                            onClick={() => {
                                window.event.preventDefault();
                                setshowAddElement(false);
                            }}
                        >
                            Hide
                        </a>
                    </>
                )}
            </div>
        </>
    );
};

export default DashboardCommonHouseNewsAdminSection;

import React from "react";
import DashboardAdmin from "./DashboardAdmin.js";
import DashboardCommon from "./DashboardCommon.js";
import DashboardOwner from "./DasboardOwner.js";

const DashboardMain = ({ apidata, isLoading, refetchApp }) => {
    if (isLoading) {
        return (
            <div>
                <h3>Please wait...</h3>
            </div>
        );
    } else {
        console.log(
            "*****************API LOADING DONE, rendering dashboard ******************"
        );
        return (
            <>
                <DashboardCommon apidata={apidata} />
                {apidata.profile === "administrator" && (
                    <DashboardAdmin apidata={apidata} refetchApp={refetchApp} />
                )}
                {apidata.profile === "owner" && (
                    <DashboardOwner apidata={apidata} />
                )}
            </>
        );
    }
};

export default DashboardMain;

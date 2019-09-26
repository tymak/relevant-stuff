import React from "react";
import DashboardCommonChats from "./common/DashboardCommonChats.js";
import DashboardCommonHouseNews from "./common/DashboardCommonHNews.js";
import DashboardCommonUserInfo from "./common/DashboardCommonUserInfo.js";
import DashboardCommonUserDocuments from "./common/DashboardCommonUserDocuments.js";
import DashboardCommonHouseRules from "./common/DashboardCommonHouseRules.js";
const DashboardCommon = ({
    apidata,
    apidata: {
        chats,
        current_user,
        communities,
        contract,
        contract_id,
        contract_url,
        notices,
        noticeboard,
        profile,
        rules,
        users
    }
}) => {
    return (
        <>
            <div className="page__main__dash dash__common">
                <DashboardCommonHouseNews
                    notices={notices}
                    noticeboard={noticeboard}
                    profile={profile}
                />
                <DashboardCommonChats
                    chats={chats}
                    communities={communities}
                    users={users}
                />
            </div>
            <div className="page__main__dash dash__common">
                <DashboardCommonUserInfo
                    user={current_user}
                    profile={profile}
                />
                {profile !== "administrator" && (
                    <DashboardCommonUserDocuments
                        contract={contract}
                        contract_id={contract_id}
                        contract_url={contract_url}
                    />
                )}
            </div>
            <div>
                <DashboardCommonHouseRules rules={rules} />
            </div>
        </>
    );
};

export default DashboardCommon;

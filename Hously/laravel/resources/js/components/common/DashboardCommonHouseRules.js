import React from "react";

const DashboardCommonHouseRules = ({ rules }) => {
    return (
        <div className="page__main__dash__item i__full">
            <div className="page__main__dash__item__head">
                <h3>House Rules</h3>
            </div>
            <div className="page__main__dash__item__body scrollable">
                <textarea className="house__rules" readOnly>
                    {rules}
                </textarea>
            </div>
        </div>
    );
};

export default DashboardCommonHouseRules;

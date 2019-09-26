import React from "react";

const DashboardCommonUserDocuments = ({
    contract_id,
    contract_url,
    contract
}) => {
    if (!contract_id || !contract_url) {
        return (
            <div className="page__main__dash__item i__small">
                <h3>My documents</h3>
                <p>Error: no contract data...</p>
            </div>
        );
    }

    return (
        <div className="page__main__dash__item i__small">
            <div className="page__main__dash__item__head">
                <h3>My documents</h3>
            </div>
            <div className="page__main__dash__item__body">
                <p>
                    <strong>Contract ID: </strong>
                    {contract_id}
                </p>
                <p>
                    <strong>Contract Type: </strong>
                    {contract.type}
                </p>
                <p>
                    <strong>Contract Scope: </strong>
                    {contract.name}
                </p>
                <p>
                    <strong>Full Document: </strong>{" "}
                    <a href={contract_url}>Download</a>
                </p>
            </div>
        </div>
    );
};

export default DashboardCommonUserDocuments;

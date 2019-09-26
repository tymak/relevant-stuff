import React from "react";

const buildingInfoDetails = ({ flats, residents, users }) => {
    return (
        <>
            <table>
                <thead>
                    <tr>
                        <th colSpan="3">Flats</th>
                    </tr>
                    <tr>
                        <th>Floor</th>
                        <th>Flat number</th>
                        <th>Resident name</th>
                    </tr>
                </thead>

                <tbody>
                    {flats.map(flat => {
                        if (flat.residential) {
                            return (
                                <>
                                    <tr>
                                        <td>{flat.floor}</td>
                                        <td>{flat.number}</td>
                                        <td>
                                            {undefined !==
                                            residents.find(
                                                resident =>
                                                    resident.flat_id == flat.id
                                                //explanation:this function is searching thru resident array and if at least one item matches the condition than it returns it if not returns undefined
                                            ) ? (
                                                residents.map(resident => {
                                                    if (
                                                        resident.flat_id ==
                                                        flat.id
                                                    ) {
                                                        return (
                                                            <>
                                                                {`${
                                                                    users[
                                                                        resident.user_id -
                                                                            1
                                                                    ].first_name
                                                                }` +
                                                                    ` ` +
                                                                    `${
                                                                        users[
                                                                            resident.user_id -
                                                                                1
                                                                        ]
                                                                            .last_name
                                                                    }`}
                                                            </>
                                                        );
                                                    }
                                                })
                                            ) : (
                                                <span>empty</span>
                                            )}
                                        </td>
                                    </tr>
                                </>
                            );
                        }
                    })}
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th colSpan="3">Non-residential units</th>
                    </tr>
                    <tr>
                        <th>Floor</th>
                        <th>Flat number</th>
                        <th>Resident name</th>
                    </tr>
                </thead>

                <tbody>
                    {flats.map(flat => {
                        if (!flat.residential) {
                            return (
                                <>
                                    <tr>
                                        <td>{flat.floor}</td>
                                        <td>{flat.number}</td>
                                        <td>
                                            {undefined !==
                                            residents.find(
                                                resident =>
                                                    resident.flat_id == flat.id
                                                //explanation:this function is searching thru resident array and if at least one item matches the condition than it returns it if not returns undefined
                                            ) ? (
                                                residents.map(resident => {
                                                    if (
                                                        resident.flat_id ==
                                                        flat.id
                                                    ) {
                                                        return (
                                                            <>
                                                                {`${
                                                                    users[
                                                                        resident.user_id -
                                                                            1
                                                                    ].first_name
                                                                }` +
                                                                    ` ` +
                                                                    `${
                                                                        users[
                                                                            resident.user_id -
                                                                                1
                                                                        ]
                                                                            .last_name
                                                                    }`}
                                                            </>
                                                        );
                                                    }
                                                })
                                            ) : (
                                                <span>empty</span>
                                            )}
                                        </td>
                                    </tr>
                                </>
                            );
                        }
                    })}
                </tbody>
            </table>
        </>
    );
};

export default buildingInfoDetails;

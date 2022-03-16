import React from "react";
import user from "../api/user";


const defaultState = {
    userData: null,
}
const defaultDispatch = () => {}

const UserContext = React.createContext(defaultState);
const UserDispatch = React.createContext(defaultDispatch);

export async function UserLogin(email, password) {
    const res = await user.login(email, password)

    return {
        type: 'login',
        payload: res
    }

}

const ContextReducer = (state, action) => {
    switch (action.type) {
        case 'login':
            return {
                ...state,
                userData: action.payload
            }

        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
};

export const UserProvider = ({ children }) => {

    const [state, dispatch] = React.useReducer(
        ContextReducer,
        defaultState
    );

    return (
        <UserContext.Provider value={state}>
            <UserDispatch.Provider value={dispatch}>
                {children}
            </UserDispatch.Provider>
        </UserContext.Provider>
    );
};

export const AuthorConsumer = (props) => {
    return (
        <UserDispatch.Consumer>
            {context => {
                if (context === undefined) {
                    throw new Error(
                        'YearConsumer must be used within a UserProvider'
                    );
                }
                return props.children(context);
            }}
        </UserDispatch.Consumer>
    );
};

export const useUserState = () => {
    const context = React.useContext(UserContext);
    if (context === undefined) {
        throw new Error('useUserState must be used within a UserProvider');
    }
    return context;
};

export const useUserDispatcher = ()  => {
    const context = React.useContext(UserDispatch);
    if (context === undefined) {
        throw new Error('useUserDispatcher must be used within a UserProvider');
    }
    return context;
}

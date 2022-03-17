import styled from 'styled-components'
import ReactLoading from 'react-loading'

export const Loading = ({ className, color = "#103764" }) => (
    <Wrapper className={className}>
        <ReactLoading type="spin" color={color} />
    </Wrapper>
)

const Wrapper = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
`
